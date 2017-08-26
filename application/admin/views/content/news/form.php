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
        ]
    ]); ?>

    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <h1><?= ($model->scenario == 'create') ? 'Добавление новости' : 'Редактирование новости' ?></h1>
                </div>

                <?php $form = \yii\bootstrap\ActiveForm::begin() ?>
                <div class="panel-body">
                    <?= $this->chunk('alerts') ?>

                    <?= $form->field($model, 'title')->label('Заголовок') ?>

                    <?php if ($model->scenario == 'update') { ?>
                        <?= $form->field($model, 'slug')->label('ЧПУ') ?>
                    <?php } ?>

                    <?= $form->field($model, 'categoryId')->label('Категория')
                        ->dropDownList(\app\models\NewsCategory::getOptions(false), [
                            'prompt' => '',
                            'encodeSpaces' => true
                        ])
                    ?>

                    <?= $form->field($model, 'textShort')->label('Краткий текст')->widget(
                        '\dosamigos\tinymce\TinyMce',
                        [
                            'language' => 'ru',
                            'options' => [
                                'rows' => 5
                            ],
                            'clientOptions' => [

                            ]
                        ]
                    ) ?>

                    <?= $form->field($model, 'textFull')->label('Полный текст')->widget(
                        '\dosamigos\tinymce\TinyMce',
                        [
                            'language' => 'ru',
                            'options' => [
                                'rows' => 10
                            ],
                            'clientOptions' => [
                                'branding' => false,
                                'plugins' => 'code link image media table',
                                'menubar' => false,
                                'toolbar' => [
                                        'undo redo | formatselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | link image media table | code',
                                ],
                                'images_upload_url' => \yii\helpers\Url::to(['upload-content-image']),
                                'images_upload_basePath' => '/'
                            ]
                        ]
                    ) ?>

                    <?= $form->field($model, 'h1')->label('h1 заголовок') ?>

                    <?= $form->field($model, 'image')->label('Картинка')->fileInput(['class' => 'form-control', 'accept' => 'image/*']) ?>

                    <?php if ($model->scenario == 'update' && $model->image) { ?>
                        <div class="form-group">
                            <img src="<?= $model->image ?>" />
                        </div>
                    <?php } ?>

                    <?= $form->field($model, 'imageText')->label('Описание картинки') ?>

                    <?= $form->field($model, 'metaTitle')->label('Мета заголовок') ?>

                    <?= $form->field($model, 'metaDescription')->label('Мета описание') ?>

                    <?= $form->field($model, 'tags')->label('Теги') ?>

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