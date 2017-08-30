<?php

namespace site\classes;

use site\models\NewsCategory;
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
                'label' => 'Новости',
                'url' => Url::to(['news/index']),
                'items' => NewsCategory::getMenu()
            ],
            'articles' => [
                'label' => 'Статьи',
                'url' => '#',
                'items' => []
            ],
            'shop' => [
                'label' => 'Магазин',
                'url' => '#',
                'items' => []
            ],
            'reviews' => [
                'label' => 'Обзоры',
                'url' => '#',
                'items' => []
            ],
            'craft' => [
                'label' => 'Сделай сам',
                'url' => '#',
                'items' => []
            ],
            'questions' => [
                'label' => 'Вопрос/Ответ',
                'url' => '#',
                'items' => []
            ],
            'announces' => [
                'label' => 'Афиша',
                'url' => '#',
                'items' => []
            ],
            'organizations' => [
                'label' => 'Организации',
                'url' => '#',
                'items' => []
            ],
            'people' => [
                'label' => 'Люди',
                'url' => '#',
                'items' => []
            ]
        ];

        if ($this->menuSection) {
            $this->view->params['activeSection'] = $this->view->params['menu'][$this->menuSection];
            unset($this->view->params['menu'][$this->menuSection]);
        }
    }
}