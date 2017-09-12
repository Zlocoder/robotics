<header>
    <div class="container">
        <div class="navbar <?= $this->params['breadcrumbs'] ? 'collapse' : 'full' ?>">
            <a class="logo" href="/">
                <img class="big" src="/images/logo.png" alt="<?= Yii::t('app', 'Роботохника и дроны') ?>" title="<?= Yii::t('app', 'Роботохника и дроны') ?>" />
                <img class="small" src="/images/logo-small.png" alt="<?= Yii::t('app', 'Роботохника и дроны') ?>" title="<?= Yii::t('app', 'Роботохника и дроны') ?>" />
            </a>

            <nav>
                <i class="mdi mdi-menu"></i>

                <ul>
                    <?php foreach ($this->params['menu'] as $item1) { ?>
                        <li>
                            <a href="<?= $item1['url'] ?>"><?= $item1['name'] ?></a>

                            <?php if ($item1['items']) { ?>
                                <div>
                                    <i class="mdi mdi-menu-right"></i>

                                    <ul>
                                        <?php foreach ($item1['items'] as $item2) { ?>
                                            <li>
                                                <a href="<?= $item2['url'] ?>"><?= $item2['name'] ?></a>

                                                <?php if ($item2['items']) { ?>
                                                    <div>
                                                        <i class="mdi mdi-menu-right"></i>

                                                        <ul>
                                                            <?php foreach ($item2['items'] as $item3) { ?>
                                                                <li><a href="<?= $item3['url'] ?>"><?= $item3['name'] ?></a></li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                <?php } ?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ul>
            </nav>

            <?php if ($this->params['breadcrumbs']) { ?>
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="<?= $this->params['breadcrumbs']['url'] ?>"><?= $this->params['breadcrumbs']['name'] ?></a></li>

                        <?php foreach ($this->params['breadcrumbs']['items'] as $item) { ?>
                            <li class="<?= $item['active'] ? 'active' : '' ?>"><a href="<?= $item['url'] ?>"><?= $item['name'] ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

            <div class="buttons">
                <a href="#"><i class="mdi mdi-magnify"></i></a>
                <a href="#"><i class="mdi mdi-account-box"></i></a>
                <a href="#"><i class="mdi mdi-cart"></i></a>
                <a href="#"><i class="mdi mdi-dots-vertical"></i></a>
            </div>
        </div>
    </div>
</header>
