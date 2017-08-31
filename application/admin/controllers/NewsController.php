<?php

namespace admin\controllers;

use admin\models\NewsFilter;
use admin\models\NewsForm;
use app\models\News;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;

class NewsController extends \admin\classes\Controller {
    public function actions() {
        return [
            'upload-content-image' => [
                'class' => 'admin\classes\UploadContentImage',
                'sizes' => [[600, 300]],
                'uploadedCallback' => [$this, 'contentImageUploaded']
            ]
        ];
    }

    public function contentImageUploaded($file) {
        $files = \Yii::$app->session->get('news-content-files', []);
        $files[] = $file;
        \Yii::$app->session->set('news-content-files', $files);
    }

    public function actionIndex() {
        $filter = new NewsFilter();
        $filter->load(\Yii::$app->request->get());

        $provider = new ActiveDataProvider([
            'query' => $filter->query,
            'pagination' => [
                'pageSize' => 10,
                'pageSizeParam' => false
            ],
            'sort' => [
                'defaultOrder' => [
                    'created' => SORT_DESC,
                ],
                'attributes' => [
                    'id',
                    'title',
                    'categoryId' => [
                        'asc' => ['category.name' => SORT_ASC, 'created' => SORT_DESC],
                        'desc' => ['category.name' => SORT_DESC, 'created' => SORT_DESC]
                    ],
                    'created'
                ]
            ]
        ]);

        return $this->render('list', [
            'dataProvider' => $provider,
            'filterModel' => $filter
        ]);
    }

    public function actionCreate() {
        $form = new NewsForm([
            'scenario' => 'create',
            'news' => new News()
        ]);

        if (\Yii::$app->request->isPost) {
            try {
                $form->load(\Yii::$app->request->post());
                $form->image = UploadedFile::getInstance($form, 'image');

                if ($form->proccess()) {
                    $this->addFlashMessage('Новость сохранена');
                    return $this->redirect(['update', 'id' => $form->news->id]);
                }
            } catch (Exception $e) {
                $this->addFlashError($e->getMessage());
            }
        }

        return $this->render('form-tabs', [
            'model' => $form
        ]);
    }

    public function actionUpdate($id) {
        if (!$news = News::findOne($id)) {
            $this->addFlashError('Новость не найдена');
            return $this->redirect(['index']);
        }

        $form = new NewsForm([
            'scenario' => 'update',
            'news' => $news
        ]);

        if (\Yii::$app->request->isPost) {
            try {
                $form->load(\Yii::$app->request->post());
                $form->image = UploadedFile::getInstance($form, 'image');

                if ($form->proccess()) {
                    $this->addFlashMessage('Новость сохранена');
                    return $this->redirect(['update', 'id' => $form->news->id]);
                }
            } catch (Exception $e) {
                $this->addFlashError($e->getMessage());
            }
        }

        return $this->render('form-tabs', [
            'model' => $form
        ]);
    }

    public function actionDelete($id) {
        if (!$news = News::findOne($id)) {
            $this->addFlashError('Новость не найдена');
            return $this->redirect(['index']);
        }

        $news->delete();
        $this->addFlashMessage('Новость удалена');
        return $this->redirect(['index']);
    }
}