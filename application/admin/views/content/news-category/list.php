<?php
/**
 * @var $dataProvider \yii\data\ActiveDataProvider
 * @var $filterModel \admin\models\NewsCategoryFilter
 */
?>

<div class="container">
    <?= $this->chunk('breadcrumbs', [
        'links' => [
            ['label' => 'Панель управления', 'url' => ['dashboard/index']],
            ['label' => 'Новости', 'url' => ['news/index']],
            ['label' => 'Категории']
        ]
    ]) ?>

    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Категории новостей</h1>
        </div>
    </div>

    <?= $this->chunk('alerts') ?>

    <div class="row">
        <div class="col-lg-12">
            <a href="<?= \yii\helpers\Url::to(['create']) ?>" class="btn btn-default pull-right">
                <i class="glyphicon glyphicon-plus"></i>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $filterModel,
                'layout' => "{items}\n{pager}",
                'emptyText' => 'Нет категорий',
                'formatter' => [
                    'class' => 'yii\i18n\Formatter',
                    'nullDisplay' => ''
                ],
                'columns' => [
                    [
                        'attribute' => 'id',
                        'headerOptions' => ['class' => 'col-num'],
                    ],
                    [
                        'attribute' => 'name',
                        'label' => 'Категория',
                        'value' => function($model) {
                            return \yii\helpers\Html::a($model->name, ['index', 'NewsCategoryFilter' => ['parentId' => $model->id]]);
                        },
                        'format' => 'html'
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => "{update} {delete}"
                    ]
                ]
            ]) ?>
        </div>
    </div>
</div>