<?php

namespace site\controllers;

class NewsController extends \site\classes\Controller {
    public $menuSection = 'news';

    public function actionIndex($slug = null) {
        if ($slug) {
            $parts = explode('/', $slug);

            foreach ($this->view->params['activeSection'] as $index => $item) {
                if ($item['slug'] == $parts[0]) {
                    $this->view->params['activeSection'][$index]['active'] = true;
                    break;
                }
            }
        }

        return $this->render('index');
    }

    public function actionNews($slug) {

    }
}