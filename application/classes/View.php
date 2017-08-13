<?php

namespace app\classes;

class View extends \yii\web\View {
    public function getChunkPath() {
        return \Yii::$app->controller->module->getViewPath() . '/../chunks';
    }

    public function chunk($chunk, $params = []) {
        return $this->renderFile("{$this->chunkPath}/{$chunk}.php", $params);
    }
}