<header>
    <div class="container">
        <div class="navbar">
            <?php if (isset($this->params['activeSection'])) { ?>
                <a class="logo" href="/">
                    <img src="/images/logo-small.png" alt="<?= Yii::t('app', 'Роботохника и дроны') ?>" title="<?= Yii::t('app', 'Роботохника и дроны') ?>" />
                </a>

                <nav class="in-section">
                    <ul>
                        <li>
                            <i class="mdi mdi-menu"></i>

                            <ul>
                                <?php foreach ($this->params['menu'] as $item1) { ?>
                                    <li>
                                        <a href="<?= $item1['url'] ?>"><?= $item1['name'] ?></a>

                                        <?php if (!empty($item1['items'])) { ?>
                                            <ul>
                                                <?php foreach ($item1['items'] as $item2) { ?>
                                                    <li>
                                                        <a href="<?= $item2['url'] ?>"><?= $item2['name'] ?></a>

                                                        <?php if (!empty($item2['items'])) { ?>
                                                            <div>
                                                                <i class="mdi mdi-menu-right"></i>

                                                                <ul>
                                                                    <?php foreach ($item2['items'] as $item3) { ?>
                                                                        <li>
                                                                            <a href="<?= $item3['url'] ?>"><?= $item3['name'] ?></a>
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
                        </li>

                        <li><a href="<?= $this->params['activeSection']['url'] ?>"><?= $this->params['activeSection']['name']?></a></li>

                        <?php if ($this->params['activeSection']['items']) { ?>
                            <?php foreach ($this->params['activeSection']['items'] as $item1) { ?>
                                <li class="<?= $item1['active'] ? 'active' : '' ?>">
                                    <a href="<?= $item1['url'] ?>"><?= $item1['name']?></a>

                                    <?php if ($item1['items']) { ?>
                                        <ul>
                                            <?php foreach ($item1['items'] as $item2) { ?>
                                                <li><a href="<?= $item2['url']?>"><?= $item2['name'] ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </nav>
            <?php } else { ?>
                <a class="logo" href="/">
                    <img src="/images/logo.png" alt="<?= Yii::t('app', 'Роботохника и дроны') ?>" title="<?= Yii::t('app', 'Роботохника и дроны') ?>" />
                </a>

                <nav>
                    <ul>
                        <?php foreach ($this->params['menu'] as $item1) { ?>
                            <li>
                                <a href="<?= $item1['url'] ?>"><?= $item1['name'] ?></a>

                                <?php if (!empty($item1['items'])) { ?>
                                    <ul>
                                        <?php foreach ($item1['items'] as $item2) { ?>
                                            <li>
                                                <a href="<?= $item2['url'] ?>"><?= $item2['name'] ?></a>

                                                <?php if (!empty($item2['items'])) { ?>
                                                    <div>
                                                        <i class="mdi mdi-menu-right"></i>

                                                        <ul>
                                                            <?php foreach ($item2['items'] as $item3) { ?>
                                                                <li>
                                                                    <a href="<?= $item3['url'] ?>"><?= $item3['name'] ?></a>
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
                </nav>
            <?php } ?>
        </div>
    </div>
</header>
