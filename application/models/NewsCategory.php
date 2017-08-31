<?php

namespace app\models;

use yii\helpers\ArrayHelper;

class NewsCategory extends \yii\db\ActiveRecord {
    public static function tableName() {
        return 'NewsCategory';
    }

    public function rules() {
        return [
            [['name', 'slug'], 'required', 'on' => 'default'],
            [['name', 'slug', 'h1', 'metaTitle'], 'string', 'max' => 128, 'on' => 'default'],
            [['metaDescription', 'redirect'], 'string', 'max' => 256, 'on' => 'default'],
            ['redirect', 'url', 'on' => 'default'],
            ['name', 'unique', 'on' => 'default'],

            [
                ['name', 'slug', 'h1', 'metaTitle', 'metaDescription', 'redirect'],
                'safe',
                'on' => 'safe'
            ]
        ];
    }

    public function behaviors() {
        return [
            'sluggable' => [
                'class' => 'yii\behaviors\SluggableBehavior',
                'attribute' => 'name',
                'ensureUnique' => true
            ]
        ];
    }

    public function beforeDelete() {
        if (parent::beforeDelete()) {
            News::deleteAll(['categoryId' => $this->id]);

            return true;
        }

        return false;
    }

    public function getNews() {
        return $this->hasMany(News::className(), ['categoryId' => 'id']);
    }

    public static function getOptions() {
        return ArrayHelper::map(self::find()->select(['id', 'name'])->orderBy('name')->asArray()->all(), 'id', 'name');
    }

    public static function getMenu() {
        return self::find()->select(['id', 'name', 'slug'])->orderBy('name')->asArray()->all();
    }
}