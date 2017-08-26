<?php

namespace admin\classes;

class Controller extends \app\classes\Controller {
    public function beforeAction($action) {
        \Yii::$app->session->set('qqq', 'www');
        if (parent::beforeAction($action)) {
            if (!($this instanceof \admin\controllers\AuthController) && \Yii::$app->admin->isGuest) {
                \Yii::$app->response->redirect(['admin/auth/login']);
                return false;
            }

            return true;
        }

        return false;
    }
}