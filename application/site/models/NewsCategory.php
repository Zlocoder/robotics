<?php

namespace site\models;

class newsCategory extends \app\models\NewsCategory {
    public static function getMenu() {
        $array = NewsCategory::find()->select(['id', 'parentId', 'name', 'slug'])->orderBy('parentId, name')->asArray()->all();
        $result = [];

        foreach ($array as $parent) {
            if ($parent['parentId']) {
                break;
            }

            $parent['children'] = [];

            foreach ($array as $child) {
                if ($child['parentId'] == $parent['id']) {
                    $parent['children'][] = $child;
                }
            }

            $result[] = $parent;
        }

        return $result;
    }
}