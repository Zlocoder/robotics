<?php

namespace admin\models;

use yii\base\Exception;
use yii\db\Query;

class NewsForm extends \yii\base\Model {
    public $title;
    public $slug;
    public $categoryId;
    public $textShort;
    public $helpTitles = [];
    public $helpTexts = [];
    public $textFull;
    public $h1;
    public $image;
    public $imageText;
    public $metaTitle;
    public $metaDescription;
    public $tags;
    public $redirect;

    private $_news;

    public function rules() {
        return [
            [
                ['title', 'categoryId', 'textShort', 'textFull'],
                'required',
                'message' => 'Введите значение',
                'on' => ['create', 'update']
            ],
            [
                ['helpTitles', 'helpTexts'], 'each',
                'rule' => [
                    'required',
                    'message' => 'Введите значение',
                ],
                'when' => function($model) {
                    return (count($model->helpTitles)) > 1 || $model->helpTitles[0] || $model->helpTexts[0];
                },
                'on' => ['create', 'update']
            ],
            [
                ['helpTitles'], 'each',
                'rule' => [
                    'string',
                    'max' => 128,
                    'tooLong' => 'Превышен лимит символов (128)'
                ],
                'when' => function($model) {
                    return (count($model->helpTitles)) > 1 || $model->helpTitles[0] || $model->helpTexts[0];
                },
                'on' => ['create', 'update']
            ],

            [
                ['title', 'slug', 'h1', 'metaTitle'], 'string',
                'max' => 128,
                'tooLong' => 'Превышен лимит символов (128)',
                'on' => ['create', 'update']
            ],
            [
                ['imageText', 'metaDescription', 'tags', 'redirect'], 'string',
                'max' => 256,
                'tooLong' => 'Превышен лимит символов',
                'on' => ['create', 'update']
            ],
            [
                'categoryId', 'exist',
                'targetClass' => 'app\models\NewsCategory',
                'targetAttribute' => 'id',
                'message' => 'Категория не существует',
                'on' => ['created', 'updated']
            ],
            [
                'image', 'image',
                'message' => 'Ошибка загрузки файла',
                'notImage' => 'Загружен файл не является картинкой',
                'on' => ['created', 'updated']
            ],

            [
                'title', 'unique',
                'targetClass' => 'app\models\News',
                'targetAttribute' => ['categoryId', 'title'],
                'message' => 'Такой заголовок уже существует',
                'on' => 'create'
            ],

            [
                'title', 'unique',
                'targetClass' => 'app\models\News',
                'targetAttribute' => ['categoryId', 'title'],
                'filter' => ['!=', 'id', $this->_news->id],
                'message' => 'Такой заголовок уже существует',
                'on' => 'update'
            ],
            [
                'slug', 'unique',
                'targetClass' => 'app\models\News',
                'targetAttribute' => ['categoryId', 'slug'],
                'filter' => ['!=', 'id', $this->_news->id],
                'message' => 'Такой ЧПУ уже сущетсвует',
                'on' => 'update'
            ]
        ];
    }

    public function setNews($news) {
        $this->_news = $news;
        $this->title = $news->title;
        $this->slug = $news->slug;
        $this->categoryId = $news->categoryId;
        $this->textShort = $news->textShort;
        $this->textFull = $news->textFull;
        $this->h1 = $news->h1;
        $this->image = $news->image ? $news->getImageUrl([200, 200]) : null;
        $this->imageText = $news->imageText;
        $this->metaTitle = $news->metaTitle;
        $this->metaDescription = $news->metaDescription;
        $this->tags = $news->tagsString;
        $this->redirect = $news->redirect;

        if ($news->textHelp) {
            $textHelpArray = $news->textHelpArray;

            foreach ($textHelpArray as $textHelp) {
                $this->helpTitles[] = $textHelp['title'];
                $this->helpTexts[] = $textHelp['text'];
            }
        }
    }

    public function getNews() {
        return $this->_news;
    }
    
    public function proccess() {
        if (!$this->validate()) {
            return false;
        }

        $this->_news->scenario = 'safe';
        $this->_news->title = $this->title;
        $this->_news->slug = $this->slug;
        $this->_news->categoryId = $this->categoryId;
        $this->_news->textShort = $this->textShort;
        $this->_news->textFull = str_replace('../../temp', '/upload', $this->textFull);
        $this->_news->h1 = $this->h1;
        $this->_news->newImage = $this->image;
        $this->_news->imageText = $this->imageText;
        $this->_news->metaTitle = $this->metaTitle;
        $this->_news->metaDescription = $this->metaDescription;
        $this->_news->tags = $this->tags;
        $this->_news->redirect = $this->redirect;

        if ($count = count($this->helpTitles)) {
            $textHelpArray = [];
            for ($current = 0; $current < $count; $current++) {
                $textHelpArray[] = [
                    'title' => $this->helpTitles[$current],
                    'text' => $this->helpTexts[$current]
                ];
            }

            $this->_news->textHelpArray = $textHelpArray;
        }

        if ($this->_news->save()) {
            $files = \Yii::$app->session->get('news-content-files', []);

            $batch = [];
            foreach ($files as $file) {
                if (strpos($this->_news->textFull, $file) !== false) {
                    $batch[] = [$this->_news->id, $file];
                    
                    rename(\Yii::getAlias("@webroot/temp/{$file}.jpg"), \Yii::getAlias("@webroot/upload/{$file}.jpg"));
                    rename(\Yii::getAlias("@webroot/temp/{$file}_600_300.jpg"), \Yii::getAlias("@webroot/upload/{$file}_600_300.jpg"));
                } else {
                    @unlink(\Yii::getAlias("@webroot/temp/{$file}.jpg"));
                    @unlink(\Yii::getAlias("@webroot/temp/{$file}_600_300.jpg"));
                }
            }

            $images = (new Query())->select('image')->from('NewsContentImage')->where(['newsId' => $this->_news->id])->column();

            if (!empty($images)) {
                \Yii::$app->db->createCommand()->delete('NewsContentImage', ['newsId' => $this->_news->id])->execute();

                foreach ($images as $image) {
                    if (strpos($this->_news->textFull, $file) !== false) {
                        @unlink(\Yii::getAlias("@webroot/upload/{$file}.jpg"));
                        @unlink(\Yii::getAlias("@webroot/upload/{$file}_600_300.jpg"));
                    } else {
                        $batch[] = [$this->_news->id, $image];
                    }
                }
            }

            if (!empty($batch)) {
                \Yii::$app->db->createCommand()->batchInsert('NewsContentImage', ['newsId', 'image'], $batch)->execute();
            }

            \Yii::$app->session->remove('news-content-files');

            return true;
        }

        throw new Exception('При сохранении новости произойшла ошибка');
    }

    public function getImageUrl() {
        if ($this->_news->image) {
            return $this->_news->getImageUrl();
        }

        return null;
    }
}