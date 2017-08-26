<?php

namespace admin\models;

use app\models\News;

class NewsFilter extends \yii\base\Model {
    public $id;
    public $title;
    public $categoryId;

    public function rules() {
        return [
            [['id', 'title', 'categoryId'], 'safe']
        ];
    }

    public function getQuery() {
        return News::find()
            ->with('category')
            ->joinWith('category')
            ->andFilterWhere(['id' => $this->id])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['categoryId' => $this->categoryId]);
    }
}