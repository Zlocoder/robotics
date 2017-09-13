<?php

namespace app\models;

use Imagine\Image\Box;
use yii\imagine\Image;

class News extends \yii\db\ActiveRecord {
    public static function tableName() {
        return 'News';
    }

    public function rules() {
        return [
            [
                'tags', 'filter',
                'filter' => function($tags) {
                    if (strpos($tags, ',')) {
                        $tags = explode(',', $tags);

                        array_walk($tags, function(&$tag) {
                            $tag = '[[' . trim($tag) . ']]';
                        });

                        $tags =  implode('', $tags);
                    }

                    return $tags;
                }
            ],

            [
                'linkedNews', 'filter',
                'filter' => function($linkedNews) {
                    if (strpos($linkedNews, ',')) {
                        $linkedNews = explode(',', $linkedNews);

                        array_walk($linkedNews, function(&$news) {
                            $news = '[[' . trim($news) . ']]';
                        });

                        $linkedNews =  implode('', $linkedNews);
                    }

                    return $linkedNews;
                }
            ],

            [['title', 'slug', 'categoryId', 'created', 'textShort', 'textFull'], 'required', 'on' => 'default'],
            [['title', 'slug', 'h1', 'metaTitle'], 'string', 'max' => 128, 'on' => 'default'],
            [['imageText', 'metaDescription', 'tags', 'redirect'], 'string', 'max'  => 256, 'on' => 'default'],
            ['title', 'unique', 'on' => 'default'],
            ['categoryId', 'exist', 'targetClass' => NewsCategory::className(), 'targetAttribute' => 'id', 'on' => 'default'],
            ['image', 'string', 'length' => 16, 'on' => 'default'],
            ['redirect', 'url', 'on' => 'default'],

            [
                [
                    'title', 'slug', 'categoryId', 'created', 'textShort', 'textHelp', 'textFull',
                    'h1', 'image', 'imageText', 'metaTitle', 'metaDescription', 'tags', 'redirect'
                ],
                'safe',
                'on' => 'safe'
            ]
        ];
    }

    public function behaviors() {
        return [
            'sluggable' => [
                'class' => 'yii\behaviors\SluggableBehavior',
                'attribute' => 'title',
                'ensureUnique' => true
            ],
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => false,
                'value' => new \yii\db\Expression('NOW()')
            ]
        ];
    }

    public function getCategory() {
        return $this->hasOne(NewsCategory::className(), ['id' => 'categoryId']);
    }

    public function getTagsArray() {
        $tags = explode(']][[', $this->tags);
        $last = count($tags) - 1;
        $tags[0] = ltrim($tags[0], '[[');
        $tags[$last] = rtrim($tags[$last], ']]');

        return $tags;
    }

    public function getTagsString() {
        return trim(str_replace(']][[', ', ', $this->tags), '[]');
    }
    
    public function getLinkedNewsArray() {
        $linkedNews = explode(']][[', $this->tags);
        $last = count($linkedNews) - 1;
        $linkedNews[0] = ltrim($linkedNews[0], '[[');
        $linkedNews[$last] = rtrim($linkedNews[$last], ']]');

        return $linkedNews;
    }

    public function getTextHelpArray() {
        if ($this->textHelp) {
            $array = explode(']][[', trim($this->textHelp, '[]'));
            foreach ($array as $index => $item) {
                $item = explode('|', $item);
                $array[$index] = [
                    'title' => $item[0],
                    'text' => $item[1]
                ];
            }

            return $array;
        }

        return [];
    }

    public function setTextHelpArray($textHelpArray) {
        if ($textHelpArray) {
            array_walk($textHelpArray, function(&$item) {
                $item = "{$item['title']}|{$item['text']}";
            });

            $this->textHelp = '[[' . implode(']][[', $textHelpArray) . ']]';
        }
    }

    public function getImageUrl($size = null) {
        $suffix = $size ? "_{$size[0]}_{$size[1]}" : '';

        if ($this->image) {
            return \Yii::getAlias("@web/upload/{$this->image}{$suffix}.png");
        }

        return \Yii::getAlias("@web/upload/default{$suffix}.png");
    }

    public function setNewImage($image) {
        if (!$image) { return; }

        if ($this->image) {
            @unlink(\Yii::getAlias("@webroot/upload/{$this->image}.png"));
        }

        $this->image = \Yii::$app->security->generateRandomString(16);
        $path = \Yii::getAlias("@webroot/upload/{$this->image}");

        $image->saveAs(\Yii::getAlias("@webroot/upload/{$this->image}"));

        $image = Image::getImagine()->open($path);
        $image->save($path . '.png');

        unlink($path);

        $sizes = [[50, 50], [100, 100], [200, 200]];

        foreach ($sizes as $size) {
            $image->thumbnail(new Box($size[0], $size[1]), $image::THUMBNAIL_OUTBOUND)->save($path . "_{$size[0]}_{$size[1]}.png");
        }
    }
}