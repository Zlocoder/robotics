<?php
if ($news->metaTitle) {
    $this->title = $news->metaTitle;
} else if ($news->h1) {
    $this->title = $news->h1;
} else {
    $this->title = $news->title;
}

$this->title .= ' - ';

if ($news->category->metaTitle) {
    $this->title .= $news->category->metaTitle;
} else if ($news->category->h1) {
    $this->title .= $news->category->h1;
} else {
    $this->title .= $news->category->name;
}

if ($news->metaDescription) {
    $this->registerMetaTag(['name' => 'description', 'content' => $news->metaDescription]);
}

if ($news->tagsString) {
    $this->registerMetaTag(['name' => 'keywords', 'content' => $news->tagsString]);
}
?>

<article class="news">
    <header>
        <h1><?= $news->h1 ? $news->h1 : $news->title ?>:</h1>

        <div class="info">
            <div class="published">
                <i class="mdi mdi-clock"></i>

                <b>Добавлено:</b>
                <span><?= Yii::$app->formatter->asDate($news->created) ?> в <? Yii::$app->formatter->asTime($news->created) ?><span>
            </div>

            <div class="author">
                <b>Автор новости:</b>
                <a href="#">admin</a>
            </div>

            <?php if ($news->tagsArray) { ?>
                <div class="tags">
                    <i class="mdi mdi-link"></i>
                    <b>Теги:</b>
                    <ul>
                        <?php foreach ($news->tagsArray as $tag) { ?>
                            <li><a href="#"><?= $tag ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </header>

    <aside>
        <!--
        <div>
            <h3>Что такое квадрокоптер?</h3>
            <p>Квадрокоптер характеризуется четырьмя несущими моторами, расположенными попарно симметрично относительно геометрического центра, и направленные вверх.</p>
        </div>

        <div>
            <h3>Что такое квадрокоптер?</h3>
            <p>Квадрокоптер характеризуется четырьмя несущими моторами, расположенными попарно симметрично относительно геометрического центра, и направленные вверх.</p>
        </div>

        <div>
            <h3>Что такое квадрокоптер?</h3>
            <p>Квадрокоптер характеризуется четырьмя несущими моторами, расположенными попарно симметрично относительно геометрического центра, и направленные вверх.</p>
        </div>

        <div>
            <h3>Что такое квадрокоптер?</h3>
            <p>Квадрокоптер характеризуется четырьмя несущими моторами, расположенными попарно симметрично относительно геометрического центра, и направленные вверх.</p>
        </div>
        -->
    </aside>

    <section class="content"><?= $content ?></section>
</article>

<section class="last-news">
    <h1>Предыдущие новости:</h1>

    <ul>
        <li class="fly-block">
            <img src="/images/temp-1.png">
            <p>
                <a href="#">Гуманоид NASA Valkyrie прошелся по пересеченной местности (+видео)</a>
                <span><i class="mdi mdi-clock"></i> 17.07.2017 в 11:35</span>
            </p>
        </li>

        <li class="fly-block">
            <img src="/images/temp-1.png">
            <p>
                <a href="#">Гуманоид NASA Valkyrie прошелся по пересеченной местности (+видео)</a>
                <span><i class="mdi mdi-clock"></i> 17.07.2017 в 11:35</span>
            </p>
        </li>

        <li class="fly-block">
            <img src="/images/temp-1.png">
            <p>
                <a href="#">Гуманоид NASA Valkyrie прошелся по пересеченной местности (+видео)</a>
                <span><i class="mdi mdi-clock"></i> 17.07.2017 в 11:35</span>
            </p>
        </li>
    </ul>
</section>

<!--
<aside class="right">
    <div class="calendar fly-block">
        <div class="title">
            <button type="button" class="prev"><i class="mdi mdi-chevron-left"></i></button>
            <span>Новости 17.07 - 23.07</span>
            <button type="button" class="next"><i class="mdi mdi-chevron-right"></i></button>
            <button type="button" class="menu"><i class="mdi mdi-dots-vertical"></i></button>
        </div>

        <div class="body">
            <ul class="names">
                <li>Пн</li>
                <li>Вт</li>
                <li>Ср</li>
                <li>Чт</li>
                <li>Пт</li>
                <li>Сб</li>
                <li>Вс</li>
            </ul>

            <ul class="dates">
                <li><a href="#">17</a></li>
                <li><a href="#">18</a></li>
                <li><a href="#" class="active">19</a></li>
                <li>20</li>
                <li>21</li>
                <li>22</li>
                <li>23</li>
            </ul>
        </div>
    </div>

    <div class="theme-news fly-block">
        <div class="title">
            <span>Новости по теме</span>
            <div>
                <button type="button"><i class="mdi mdi-chevron-left"></i></button>
                <button type="button"><i class="mdi mdi-chevron-right"></i></button>
                <button type="button"><i class="mdi mdi-dots-vertical"></i></button>
            </div>
        </div>

        <div class="body">
            <img src="/images/theme-news.png" />
            <p>
                <a href="#">WienerDrone – дрон для доставки хот-догов от Oscar Mayer (+видео)</a>
                <span><i class="mdi mdi-clock"></i> 17.07.2017 в 11:35</span>
            </p>
        </div>
    </div>

    <div class="shop-products fly-block">
        <div class="title">
            <span>У нас в магазине</span>
            <div>
                <button type="button"><i class="mdi mdi-chevron-left"></i></button>
                <button type="button"><i class="mdi mdi-chevron-right"></i></button>
                <button type="button"><i class="mdi mdi-dots-vertical"></i></button>
            </div>
        </div>

        <div class="body">
            <img src="/images/shop-products.png" />
            <p>
                <a href="#">Iclebo Arte Silver / Carbon / Black / Red</a>
                <span><b>Отзывы:</b> <a href="#">17</a></span>
                <span><b>Рейтинг:</b> </span>
                <span class="price">13 990 грн</span>
                <a class="more" href="#">Подробнее</a>
            </p>
        </div>

        <div class="body">
            <span><i class="mdi mdi-phone"></i> (096) 000-43-06 / (066) 096-50-56 / (063) 243-32-55</span>
            <span><i class="mdi mdi-timelapse"></i> <b>Мы открыты:</b> Пн - Пт: 9-18 / Сб, Вс: 9-15</span>
        </div>
    </div>
</aside>
-->
