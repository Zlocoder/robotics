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

        <?php if (!\Yii::$app->admin->isGuest) { ?>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?= Url::to(['auth/logout']) ?>">Выйти (<?= \Yii::$app->admin->login ?>)</a></li>
            </ul>
        <?php } ?>
    </div>

    <?php \yii\bootstrap\NavBar::end(); ?>
</header>
