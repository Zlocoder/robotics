<?php

return [
    'debug' => 'yii\debug\Module',
    'site' => [
        'class' => 'yii\base\Module',
        'controllerNamespace' => 'site\controllers',
        'viewPath' => '@site/views/content',
        'layoutPath' => '@site/views/layouts',
        'layout' => 'main'
    ],
    'admin' => [
        'class' => 'yii\base\Module',
        'controllerNamespace' => 'admin\controllers',
        'viewPath' => '@admin/views/content',
        'layoutPath' => '@admin/views/layouts',
        'layout' => 'main',
        'defaultRoute' => 'dashboard'
    ],
    'filemanager' => [
        'class'         => 'linchpinstudios\filemanager\Module',
        'path'          => '/upload'
    ],];