<?php

namespace admin\controllers;

use admin\models\LoginForm;

class AuthController extends \admin\classes\Controller {
    public $layout = 'auth';

    public function actionLogin() {
        $form = new LoginForm();

        if (\Yii::$app->request->isPost) {
            $form->load(\Yii::$app->request->post());

            if ($form->process()) {
                return $this->redirect(['dashboard/index']);
            }
        }

        return $this->render('/login', [
            'model' => $form
        ]);
    }

    public function actionLogout() {
        if (!\Yii::$app->admin->isGuest) {
            \Yii::$app->admin->logout();
        }

        return $this->redirect(['login']);
    }
}