<header>
    <div class="container">
        <div class="navbar">
            <a class="logo" href="/">
                <img src="/images/logo.png" alt="<?= Yii::t('app', 'Роботохника и дроны') ?>" title="<?= Yii::t('app', 'Роботохника и дроны') ?>" />
            </a>

            <nav>
                <?php if (isset($this->params['activeSection'])) { ?>

                <?php } else { ?>
                    <ul>
                        <?php foreach ($this->params['mainMenu'] as $item1) { ?>
                            <li>
                                <a href="<?= $item1['url'] ?>"><?= $item1['label'] ?></a>

                                <?php if (!empty($item1['items'])) { ?>
                                    <ul>
                                        <?php foreach ($item1['items'] as $item2) { ?>
                                            <li>
                                                <a href="<?= $item2['url'] ?>"><?= $item2['label'] ?></a>

                                                <?php if (!empty($item2['items'])) { ?>
                                                    <div>
                                                        <i class="mdi mdi-menu-right"></i>

                                                        <ul>
                                                            <?php foreach ($item2['items'] as $item3) { ?>
                                                                <li>
                                                                    <a href="<?= $item3['url'] ?>"><?= $item3['label'] ?></a>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                <?php } ?>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </nav>
        </div>
    </div>
</header>
