<?php

namespace app\controllers;

class CronController extends \app\classes\Controller {
    public function actionDeleteTempImages() {
        $files = scandir(\Yii::getAlias('@webroot/temp'));

        array_shift($files);
        array_shift($files);

        foreach ($files as $file) {
            unlink(\Yii::getAlias("@webroot/temp/{$file}"));
        }
    }
}