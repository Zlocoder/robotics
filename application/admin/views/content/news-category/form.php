<?php
/**
 * @var $model \admin\models\NewsCategoryForm ?>
 */
?>

<div class="container">
    <?= $this->chunk('breadcrumbs', [
        'links' => [
            ['label' => 'Панель управления', 'url' => ['dashboard/index']],
            ['label' => 'Новости', 'url' => ['news/index']],
            ['label' => 'Категории', 'url' => ['index']],
        ]
    ]); ?>

    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <h1><?= ($model->scenario == 'create') ? 'Добавление категории' : 'Редактирование категории' ?></h1>
                </div>

                <?php $form = \yii\bootstrap\ActiveForm::begin() ?>
                    <div class="panel-body">
                        <?= $this->chunk('alerts') ?>

                        <?= $form->field($model, 'name')->label('Название') ?>

                        <?php if ($model->scenario == 'update') { ?>
                            <?= $form->field($model, 'slug')->label('ЧПУ') ?>
                        <?php } ?>

                        <?= $form->field($model, 'h1')->label('h1 заголовок') ?>

                        <?= $form->field($model, 'metaTitle')->label('Мета заголовок') ?>

                        <?= $form->field($model, 'metaDescription')->label('Мета описание') ?>

                        <?= $form->field($model, 'redirect')->label('Переадресация') ?>
                    </div>

                    <div class="panel-footer text-center">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                <?php \yii\bootstrap\ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>