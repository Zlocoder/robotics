<?php

namespace site\classes;

use app\models\NewsCategory;
use yii\helpers\Url;

class Controller extends \app\classes\Controller {
    public function beforeAction($action) {
        if (parent::beforeAction($action)) {
            $this->initMainMenu();

            return true;
        }

        return false;
    }

    public function initMainMenu() {
        $this->view->params['menu'] = [
            'news' => [
                'name' => 'Новости',
                'url' => Url::to(['news/index']),
                'items' => array_map(function($item) {
                    $item['url'] = Url::to(['news/index', 'slug' => $item['slug']]);
                    return $item;
                }, NewsCategory::getMenu())
            ],
            'articles' => [
                'name' => 'Статьи',
                'url' => '#',
                'items' => []
            ],
            'shop' => [
                'name' => 'Магазин',
                'url' => '#',
                'items' => []
            ],
            'reviews' => [
                'name' => 'Обзоры',
                'url' => '#',
                'items' => []
            ],
            'craft' => [
                'name' => 'Сделай сам',
                'url' => '#',
                'items' => []
            ],
            'questions' => [
                'name' => 'Вопрос/Ответ',
                'url' => '#',
                'items' => []
            ],
            'announces' => [
                'name' => 'Афиша',
                'url' => '#',
                'items' => []
            ],
            'organizations' => [
                'name' => 'Организации',
                'url' => '#',
                'items' => []
            ],
            'people' => [
                'name' => 'Люди',
                'url' => '#',
                'items' => []
            ]
        ];
    }
}