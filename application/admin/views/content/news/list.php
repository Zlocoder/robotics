<?php
/**
 * @var $dataProvider \yii\data\ActiveDataProvider
 * @var $filterModel \admin\models\NewsFilter
 */
?>

<div class="container">
    <?= $this->chunk('breadcrumbs', [
        'links' => [
            ['label' => 'Панель управления', 'url' => ['dashboard/index']],
            ['label' => 'Новости']
        ]
    ]) ?>

    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Новости</h1>
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
                'emptyText' => 'Нет новостей',
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
                        'attribute' => 'image',
                        'value' => function($model) {
                            return \yii\helpers\Html::img($model->getImageUrl([50,50]));
                        },
                        'format' => 'html'
                    ],
                    [
                        'attribute' => 'title',
                        'label' => 'Заголовок',
                    ],
                    [
                        'attribute' => 'categoryId',
                        'label' => 'Категория',
                        'value' => 'category.name',
                        'filter' => \app\models\NewsCategory::getOptions(false)
                    ],
                    [
                        'attribute' => 'created',
                        'label' => 'Дата создания',
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