<?php

namespace admin\controllers;

class DashboardController extends \admin\classes\Controller {
    public function actionIndex() {
        $this->addFlashError('error message');

        $this->addFlashMessage('message');

        return $this->render('/dashboard');
    }
}