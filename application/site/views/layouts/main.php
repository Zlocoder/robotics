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
    <title>Document</title>
    <?= $this->head() ?>
</head>

<body>
    <?= $this->beginBody() ?>

    <?= $this->chunk('header') ?>

    <main>
        <div class="content">
            <?= $content ?>
        </div>
    </main>

    <?= $this->chunk('footer') ?>

    <?= $this->endBody() ?>
</body>
</html>
<?= $this->endPage() ?>