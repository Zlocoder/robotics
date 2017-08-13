<?php

namespace app\classes;

class Controller extends \yii\web\Controller {
    public function addFlashMessage($text) {
        if (\Yii::$app->session->hasFlash('messages')) {
            $messages = \Yii::$app->session->hasFlash('messages');
        } else {
            $messages = [];
        }

        $messages[] = $text;
        \Yii::$app->session->setFlash('messages', $messages);
    }

    public function addFlashError($text) {
        if (\Yii::$app->session->hasFlash('errors')) {
            $messages = \Yii::$app->session->hasFlash('errors');
        } else {
            $messages = [];
        }

        $messages[] = $text;
        \Yii::$app->session->setFlash('errors', $messages);
    }

    public function render($view, $params = []) {
        $this->view->params['errors'] = \Yii::$app->session->removeFlash('errors');
        $this->view->params['messages'] = \Yii::$app->session->removeFlash('messages');

        return parent::render($view, $params);
    }
}