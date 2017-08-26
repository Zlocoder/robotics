<?php

return [
    'db' => require(__DIR__ . '/db.php'),
    'request' => [
        'cookieValidationKey' => 'RO10EEu9rvKLlwrH4i92vTkY8OjNAZsm',
    ],
    'assetManager' => [
        'forceCopy' => true
    ],
    'view' => [
        'class' => 'app\classes\View',
    ],
    'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => require(__DIR__ . '/url_rules.php'),
    ],
    'user' => [
        'class' => 'app\classes\User',
        'identityClass' => false,
        'enableAutoLogin' => true,
        'idParam' => 'user'
    ],
    'admin' => [
        'class' => 'app\classes\User',
        'identityClass' => 'admin\models\AdminUser',
        'enableAutoLogin' => true,
        'idParam' => 'admin'
    ],
    'mailer' => [
        'class' => 'yii\swiftmailer\Mailer',
        'useFileTransport' => false,
        'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => 'smtp.gmail.com',
            'username' => 'dev.george.lemish@gmail.com',
            'password' => 'kaskad13',
            'port' => '587',
            'encryption' => 'tls',
        ],
    ]
];