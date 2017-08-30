<?php

namespace site\models;

use yii\helpers\Url;

class newsCategory extends \app\models\NewsCategory {
    public static function getMenu() {
        $array = NewsCategory::find()->select(['id', 'parentId', 'name', 'slug'])->orderBy('parentId, name')->asArray()->all();
        $menu = [];

        foreach ($array as $parent) {
            if ($parent['parentId']) {
                break;
            }

            $parent['url'] = Url::to(['news/index', 'slug' => $parent['slug']]);
            $parent['items'] = [];

            foreach ($array as $child) {
                if ($child['parentId'] == $parent['id']) {
                    $child['url'] = Url::to(['news/index', 'slug' => $parent['slug'] . '/' . $child['slug']]);
                    $parent['items'][] = $child;
                }
            }

            $menu[] = $parent;
        }

        return $menu;
    }
}