<?php

namespace site\assets;

class SiteAsset extends \yii\web\AssetBundle {
    public $sourcePath = '@site/views/assets';
    public $baseUrl = '@web';

    public $css = [
        'https://fonts.googleapis.com/css?family=Roboto',
        'https://cdn.materialdesignicons.com/2.0.46/css/materialdesignicons.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css',
        'css/style.css',
        'css/320/style.css',
        'css/320/navbar.css',
        'css/970/style.css',
        'css/970/navbar.css',
        'css/1170/style.css',
        'css/1170/navbar.css'
    ];

    public $js = [
        'js/main.js'
    ];

    public $depends = [
        'yii\web\YiiAsset'
    ];
}
