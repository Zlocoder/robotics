<?php

namespace site\controllers;

class SiteController extends \site\classes\Controller {
    public function actionIndex() {
        return $this->render('/index');
    }
}