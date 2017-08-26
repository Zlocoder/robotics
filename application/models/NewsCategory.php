<?php

namespace app\models;

use yii\helpers\ArrayHelper;

class NewsCategory extends \yii\db\ActiveRecord {
    public static function tableName() {
        return 'newsCategory';
    }

    public function rules() {
        return [
            [
                'parents', 'filter',
                'filter' => function() {
                    if ($this->parentId) {
                        return $this->parent->parents . "[[{$this->parentId}]]";
                    }

                    return null;
                }
            ],

            [['name', 'slug'], 'required', 'on' => 'default'],
            [['name', 'slug', 'parents', 'h1', 'metaTitle'], 'string', 'max' => 128, 'on' => 'default'],
            [['metaDescription', 'redirect'], 'string', 'max' => 256, 'on' => 'default'],
            ['redirect', 'url', 'on' => 'default'],
            ['parentId', 'exist', 'targetAttribute' => 'id', 'on' => 'default'],
            ['name', 'unique', 'targetAttribute' => ['parentId', 'name'], 'on' => 'default'],

            [
                [
                    'name', 'slug', 'parentId',
                    'h1', 'metaTitle', 'metaDescription', 'redirect'
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
                'attribute' => 'name',
                'ensureUnique' => true,
                'uniqueValidator' => [
                    'targetAttribute' => ['parentId', 'slug']
                ]
            ]
        ];
    }

    public function beforeDelete() {
        if (parent::beforeDelete()) {
            News::deleteAll(['like', 'categories', "[[{$this->id}]]"]);
            NewsCategory::deleteAll(['like', 'parents', "[[{$this->id}]]"]);

            return true;
        }

        return false;
    }

    public function getParent() {
        return $this->hasOne(self::className(), ['id' => 'parentId']);
    }

    public function getParents() {
        if ($this->parents) {
            $ids = explode('|', $this->parents);
            $ids = array_walk($ids, function(&$str) {
                $str = trim($str, '[]');
            });

            return self::find()->where(['id' => $ids]);
        }

        return null;
    }

    public function getChildren() {
        return $this->hasMany(self::className(), ['parentId' => 'id']);
    }

    public function getChildrenRecursive() {
        return self::find()->where(['like', 'parents', "[[{$this->id}]]"]);
    }

    public function getNews() {
        return $this->hasMany(News::className(), ['categoryId' => 'id']);
    }

    public function getNewsRecursive() {
        return News::find()->where(['like', 'categories', "[[{$this->id}]]"]);
    }

    public static function getOptions($root = true) {
        if ($root) {
            return ArrayHelper::map(
                self::find()->with('parent')
                    ->where(['parentId' => null])->select(['id', 'name'])->orderBy('name')->asArray()->all(),
                'id', 'name'
            );
        }

        $array = NewsCategory::find()->select(['id', 'parentId', 'name'])->orderBy('parentId, name')->asArray()->all();
        $result = [];

        foreach ($array as $parent) {
            if ($parent['parentId']) {
                break;
            }

            $result[$parent['id']] = $parent['name'];

            foreach ($array as $child) {
                if ($child['parentId'] == $parent['id']) {
                    $result[$child['id']] = '    ' . $child['name'];
                }
            }
        }

        return $result;
    }
}