<?php

namespace admin\models;

use app\models\NewsCategory;
use yii\helpers\ArrayHelper;

class NewsCategoryFilter extends \yii\base\Model {
    public $id;
    public $parentId;
    public $name;

    public function rules() {
        return [
            [['id', 'parentId', 'name'], 'safe']
        ];
    }

    public function getQuery() {
        return NewsCategory::find()
            ->from(NewsCategory::tableName() . ' as category')
            ->with('parent')
            ->joinWith('parent as parent')
            ->andFilterWhere(['category.id' => $this->id])
            ->andFilterWhere(['category.parentId' => $this->parentId])
            ->andFilterWhere(['like', 'category.name', $this->name]);
    }
}