<?php

namespace admin\controllers;

use admin\models\NewsCategoryFilter;
use admin\models\NewsCategoryForm;
use app\models\NewsCategory;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

class NewsCategoryController extends \admin\classes\Controller {
    public function actionIndex() {
        $filter = new NewsCategoryFilter();
        $filter->load(\Yii::$app->request->get());

        $provider = new ActiveDataProvider([
            'query' => $filter->query,
            'pagination' => [
                'pageSize' => 10,
                'pageSizeParam' => false
            ],
            'sort' => [
                'attributes' => [
                    'id',
                    'parentId' => [
                        'asc' => ['parent.name' => SORT_ASC, 'name' => SORT_ASC],
                        'desc' => ['parent.name' => SORT_DESC, 'name' => SORT_ASC],
                        'default' => SORT_ASC
                    ],
                    'name'
                ],
                'defaultOrder' => [
                    'parentId' => SORT_ASC,
                    'name' => SORT_ASC
                ],
            ]
        ]);

        return $this->render('list', [
            'dataProvider' => $provider,
            'filterModel' => $filter
        ]);
    }

    public function actionCreate() {
        $form = new NewsCategoryForm([
            'scenario' => 'create',
            'category' => new NewsCategory()
        ]);

        if (\Yii::$app->request->isPost) {
            try {
                $form->load(\Yii::$app->request->post());

                if ($form->process()) {
                    $this->addFlashMessage('Категория сохранена');
                    return $this->redirect(['update', 'id' => $form->category->id]);
                }
            } catch (Exception $e) {
                $this->addFlashError($e->getMessage());
            }
        }

        return $this->render('form', [
            'model' => $form
        ]);
    }

    public function actionUpdate($id) {
        if (!$category = NewsCategory::findOne($id)) {
            $this->addFlashError('Категория не найдена');
            return $this->redirect(['index']);
        }

        $form = new NewsCategoryForm([
            'scenario' => 'update',
            'category' => $category
        ]);

        if (\Yii::$app->request->isPost) {
            try {
                $form->load(\Yii::$app->request->post());

                if ($form->process()) {
                    $this->addFlashMessage('Категория сохранена');
                    return $this->redirect(['update', 'id' => $form->category->id]);
                }
            } catch (Exception $e) {
                $this->addFlashError($e->getMessage());
            }
        }

        return $this->render('form', [
            'model' => $form
        ]);
    }

    public function actionDelete($id, $deleteAll = false) {
        if (!$category = NewsCategory::findOne($id)) {
            $this->addFlashError('Категория не найдена');
            return $this->redirect(['index']);
        }

        $hasChildren = $category->getChildrenRecursive()->exists();
        $hasNews = $category->getNewsRecursive()->exists();

        if (($hasChildren || $hasNews) && !$deleteAll) {
            $message = '';

            if ($hasChildren && $hasNews) {
                $message = 'В категории есть дочерние категории и новости';
            } else if ($hasChildren) {
                $message = 'В категории есть дочерние категории';
            } else if ($hasNews) {
                $message = 'В категории есть новости';
            }

            if ($message && !$deleteAll) {
                $this->addFlashMessage(
                    $message . ' ' .
                    Html::a('Удалить всё', ['delete', 'id' => $id, 'deleteAll' => true], ['class' => 'btn btn-default']) . ' ' .
                    Html::button('Отменить', ['class' => 'btn btn-default', 'data' => ['dismiss' => 'alert']])
                );

                return $this->redirect(['index']);
            }
        }

        $category->delete();
        $this->addFlashMessage('Категория удалена');
        return $this->redirect(['index']);
    }
}