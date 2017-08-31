<?php

namespace app\models;

use Imagine\Image\Box;
use yii\imagine\Image;

class News extends \yii\db\ActiveRecord {
    public static function tableName() {
        return 'news';
    }

    public function rules() {
        return [
            [
                'categories', 'filter',
                'filter' => function() {
                    return $this->category->parents . "[[{$this->categoryId}]]";
                }
            ],

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

            [['title', 'slug', 'categoryId', 'categories', 'created', 'textShort', 'textFull'], 'required', 'on' => 'default'],
            [['title', 'slug', 'categories', 'h1', 'metaTitle'], 'string', 'max' => 128, 'on' => 'default'],
            [['imageText', 'metaDescription', 'tags', 'redirect'], 'string', 'max'  => 256, 'on' => 'default'],
            ['title', 'unique', 'targetAttribute' => ['categoryId', 'title'], 'on' => 'default'],
            ['categoryId', 'exist', 'targetClass' => NewsCategory::className(), 'targetAttribute' => 'id', 'on' => 'default'],
            ['image', 'string', 'length' => 16, 'on' => 'default'],
            ['redirect', 'url', 'on' => 'default'],

            [
                [
                    'title', 'slug', 'categoryId', 'created', 'textShort', 'textFull',
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
                'ensureUnique' => true,
                'uniqueValidator' => [
                    'targetAttribute' => ['categoryId', 'slug']
                ]
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

    public function getCategoryRecursive() {
        $ids = explode('|', $this->categories);
        array_walk($ids, function(&$str) {
            $str = trim($str, '[]');
        });

        return NewsCategory::find()->where(['id' => $ids])->orderBy(['id' => SORT_DESC]);
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