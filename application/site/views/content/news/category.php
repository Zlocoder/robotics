<?php

if ($category) {
    if ($category->metaTitle) {
        $this->title = $category->metaTitle;
    } else if ($category->h1) {
        $this->title = $category->h1;
    } else {
        $this->title = $category->name;
    }

    if ($category->metaDescription) {
        $this->registerMetaTag(['name' => 'description', 'content' => $category->metaDescription]);
    }
} else {
    $this->title = 'Новости робототехники и новинки роботов / Новости науки, хай тек техники, технологий и новости беспилотников - Robotics';
}
?>

<?php if ($category) { ?>
    <h1><?= $category->h1 ? $category->h1 : $category->name ?></h1>
<?php } else { ?>
    <h1>Новости робототехники, новинки и виды роботов:</h1>
<?php } ?>

<?php if ($news) { ?>
    <?php foreach ($news as $item) { ?>
        <div>
            <h2><a href="<?= \yii\helpers\Url::to(['news/news', 'slug' => "{$item->category->slug}/{$item->slug}"]) ?>"><?= $item->title ?></a></h2>
            <img src="<?= $item->getImageUrl([200, 200]) ?>" alt="<?= $item->title ?>" title="<?= $item->title ?>" />
            <p><?= $item->textShort ?></p>
        </div>
    <?php } ?>
<?php } else { ?>
    нет новостей
<?php } ?>