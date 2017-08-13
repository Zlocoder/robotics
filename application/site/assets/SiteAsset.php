<?php

namespace site\assets;

class SiteAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@site/views/assets';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css'
    ];
    public $js = [
        'js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
