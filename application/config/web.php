<?php

return [
    'id' => 'Robotics',
    'name' => 'Robotics',
    'aliases' => [
        'admin' => '@app/admin',
        'site' => '@app/site'
    ],
    'basePath' => dirname(__DIR__),
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'runtimePath' => dirname(dirname(__DIR__)) . '/runtime',
    'viewPath' => dirname(__DIR__) . '/views/content',
    'layoutPath' => dirname(__DIR__) . '/views/layouts',
    'components' => require(__DIR__ . '/web_components.php'),
    'modules' => require(__DIR__ . '/web_modules.php'),
    'params' => require(__DIR__ . '/params.php'),
    'bootstrap' => ['debug'],
    'defaultRoute' => ''
];