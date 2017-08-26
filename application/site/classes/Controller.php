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
        if ($this instanceof \site\controllers\NewsController && $this->action->id == 'index') {
            $activeSection = 'news';

            if ($this->actionParams['slug']) {
                $parts = explode('/', $this->actionParams['slug']);
                $activeNewsCategory = $parts[0];
            }
        }

        $this->view->params['mainMenu'] = [];

        $news = [
            'label' => 'Новости',
            'url' => Url::to(['news/index']),
            'items' => []
        ];

        foreach (NewsCategory::getMenu() as $parent) {
            $item = [
                'label' => $parent['name'],
                'url' => Url::to(['news/index', 'slug' => $parent['slug']]),
                'items' => [],
                'active' => isset($activeNewsCategory) && ($activeNewsCategory == $parent['slug'])
            ];

            foreach ($parent['children'] as $child) {
                $item['items'][] = [
                    'label' => $child['name'],
                    'url' => Url::to(['news/index', 'slug' => $parent['slug'] . '/' . $child['slug']])
                ];
            }

            $news['items'][] = $item;
        }

        if ($activeSection && $activeSection == 'news') {
            $this->view->params['activeSection'] = $news;
        } else {
            $this->view->params['mainMenu'][] = $news;
        }

        $this->view->params['mainMenu'][] = [
            'label' => 'Статьи',
            'url' => '#',
            'items' => []
        ];

        $this->view->params['mainMenu'][] = [
            'label' => 'Статьи',
            'url' => '#',
            'items' => []
        ];

        $this->view->params['mainMenu'][] = [
            'label' => 'Магазин',
            'url' => '#',
            'items' => []
        ];

        $this->view->params['mainMenu'][] = [
            'label' => 'Обзоры',
            'url' => '#',
            'items' => []
        ];

        $this->view->params['mainMenu'][] = [
            'label' => 'Сделай сам',
            'url' => '#',
            'items' => []
        ];

        $this->view->params['mainMenu'][] = [
            'label' => 'Вопрос/Ответ',
            'url' => '#',
            'items' => []
        ];

        $this->view->params['mainMenu'][] = [
            'label' => 'Афиша',
            'url' => '#',
            'items' => []
        ];

        $this->view->params['mainMenu'][] = [
            'label' => 'Организации',
            'url' => '#',
            'items' => []
        ];

        $this->view->params['mainMenu'][] = [
            'label' => 'Люди',
            'url' => '#',
            'items' => []
        ];
    }
}