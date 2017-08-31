<?php

namespace admin\models;

use app\models\NewsCategory;
use yii\helpers\ArrayHelper;

class NewsCategoryFilter extends \yii\base\Model {
    public $id;
    public $name;

    public function rules() {
        return [
            [['id', 'name'], 'safe']
        ];
    }

    public function getQuery() {
        return NewsCategory::find()
            ->andFilterWhere(['category.id' => $this->id])
            ->andFilterWhere(['like', 'category.name', $this->name]);
    }
}