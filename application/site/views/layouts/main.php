<?php

\site\assets\SiteAsset::register($this);
?>

<?= $this->beginPage() ?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $this->title ? $this->title : 'Робототехника Украина. Роботы, мехатроника, кибернетика, нанотехнологии, наука и техника' ?> - Robotics</title>
    <?= $this->head() ?>
</head>

<body>
    <?= $this->beginBody() ?>

    <?= $this->chunk('header') ?>

    <div class="container">
        <?= $content ?>
    </div>

    <?= $this->chunk('footer') ?>

    <?= $this->endBody() ?>
</body>
</html>
<?= $this->endPage() ?>