<?php

namespace admin\models;

use app\models\NewsCategory;
use yii\base\Exception;
use yii\helpers\ArrayHelper;

class NewsCategoryForm extends \yii\base\Model {
    public $name;
    public $slug;
    public $redirect;
    public $metaTitle;
    public $metaDescription;
    public $h1;

    private $_category;

    public function rules() {
        return [
            [
                'name', 'required',
                'message' => 'Введите название',
                'on' => ['create', 'update']
            ],
            [
                ['name', 'h1', 'metaTitle'], 'string',
                'max' => 128,
                'tooLong' => 'Превышен лимит символов (128)',
                'on' => ['create', 'update']
            ],
            [
                ['metaDescription', 'redirect'], 'string',
                'max' => 256,
                'tooLong' => 'Превышен лимит символов (256)',
                'on' => ['create', 'update']
            ],
            [
                'redirect', 'url',
                'message' => 'Некорректный url',
                'on' => ['create', 'update']
            ],

            [
                'name', 'unique',
                'targetClass' => NewsCategory::className(),
                'message' => 'Такое название уже существует',
                'on' => ['create']
            ],

            [
                'slug', 'string',
                'max' => 128,
                'tooLong' => 'Превышен лимит символов (128)',
                'on' => ['update']
            ],
            [
                'slug', 'match',
                'pattern' => '/^[a-z0-9][a-z0-9 -]*$/',
                'message' => 'ЧПУ может содержать только латинские буквы, цифры, пробел и тире',
                'on' => ['update']
            ],
            [
                'name', 'unique',
                'targetClass' => NewsCategory::className(),
                'filter' => ['!=', 'id', $this->_category->id],
                'message' => 'Такое название уже существует',
                'on' => ['update']
            ],
            [
                'slug', 'unique',
                'targetClass' => NewsCategory::className(),
                'filter' => ['!=', 'id', $this->_category->id],
                'message' => 'Такой ЧПУ уже существует',
                'on' => ['update']
            ],
        ];
    }

    public function setCategory($category) {
        $this->_category = $category;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->h1 = $category->h1;
        $this->metaTitle = $category->metaTitle;
        $this->metaDescription = $category->metaDescription;
        $this->redirect = $category->redirect;
    }

    public function getCategory() {
        return $this->_category;
    }

    public function process() {
        if (!$this->validate()) {
            return false;
        }

        $this->_category->scenario = 'safe';
        $this->_category->name = $this->name;
        $this->_category->slug = $this->slug;
        $this->_category->h1 = $this->h1;
        $this->_category->metaTitle = $this->metaTitle;
        $this->_category->metaDescription = $this->metaDescription;
        $this->_category->redirect = $this->redirect;

        if ($this->_category->save()) {
            return true;
        }

        throw new Exception('При сохранении категории возникла ошибка');
    }
}