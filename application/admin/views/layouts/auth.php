<?php \admin\assets\AdminAsset::register($this); ?>

<?= $this->beginPage() ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <?= $this->head() ?>
</head>
<body>
    <?= $this->beginBody() ?>

    <?= $content ?>

    <?= $this->endBody() ?>
</body>
</html>
<?= $this->endPage() ?>