<?php

use yii\helpers\Url;

?>

<header>
    <?php \yii\bootstrap\NavBar::begin([
        'brandLabel' => \Yii::$app->name,
        'brandUrl' => Url::to(['dashboard/index']),
        'options' => [
            'class' => 'navbar navbar-inverse navbar-fixed-top'
        ]
    ]) ?>

    <div class="container">
        <?= \yii\bootstrap\Nav::widget([
            'options' => [
                'class' => 'nav navbar-nav'
            ],
            'items' => [
                ['label' =>'Новости', 'items' => [
                    ['label' => 'Категории', 'url' => Url::to(['news-category/index'])],
                    ['label' => 'Новости', 'url' => Url::to(['news/index'])],
                ]]
            ]
        ]) ?>
    </div>

    <?php \yii\bootstrap\NavBar::end(); ?>
</header>
