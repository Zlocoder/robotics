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
        <div class="col-lg-10 col-lg-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <h1><?= ($model->scenario == 'create') ? 'Добавление новости' : 'Редактирование новости' ?></h1>
                </div>

                <?php $form = \yii\bootstrap\ActiveForm::begin([
                    'enableClientValidation' => false
                ]) ?>

                <div class="panel-body">
                    <?= $this->chunk('alerts') ?>

                    <?= \yii\bootstrap\Tabs::widget([
                        'items' => [
                            [
                                'label' => 'Основная информация',
                                'content' => $this->render('form-tab-main', ['model' => $model, 'form' => $form]),
                                'active' => true
                            ],
                            [
                                'label' => 'Сопроводительный текст',
                                'content' => $this->render('form-tab-help-text', ['model' => $model, 'form' => $form]),
                                'active' => false
                            ],
                            [
                                'label' => 'Новости по теме',
                                'content' => $this->render('form-tab-linked-news', ['model' => $model, 'form' => $form]),
                                'active' => false
                            ]
                        ]
                    ]) ?>
                </div>

                <div class="panel-footer text-center">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
                <?php \yii\bootstrap\ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>