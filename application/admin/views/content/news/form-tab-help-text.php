<div class="row">
    <div class="col-lg-12">
        <?php $count = count($model->helpTitles) ?>

        <?php if ($count) { ?>
            <?php for ($current = 0; $current < $count; $current++) { ?>
                <div class="panel panel-default">
                    <div class="panel-heading">Сопроводительный текст <span><?= $current + 1 ?></span></div>

                    <div class="panel-body">
                        <?= $form->field($model, "helpTitles[{$current}]")->label('Заголовок') ?>

                        <?= $form->field($model, "helpTexts[{$current}]")->label('Текст')->textarea() ?>
                    </div>

                    <div class="panel-footer text-center">
                        <button class="btn btn-default news-help-text-delete">Удалить</button>
                        <?php if ($current == ($count - 1)) { ?>
                            <button class="btn btn-default news-help-text-add">Добавить</button>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="panel panel-default">
                <div class="panel-heading">Сопроводительный текст <span>1</span></div>

                <div class="panel-body">
                    <?= $form->field($model, 'helpTitles[]')->label('Заголовок') ?>

                    <?= $form->field($model, 'helpTexts[]')->label('Текст')->textarea() ?>
                </div>

                <div class="panel-footer text-center">
                    <button type="button" class="btn btn-default news-help-text-delete">Удалить</button>
                    <button type="button" class="btn btn-default news-help-text-add">Добавить</button>
                </div>
            </div>
        <?php } ?>
    </div>
</div>