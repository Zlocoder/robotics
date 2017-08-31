<?php

namespace site\controllers;

use app\models\News;
use site\models\NewsCategory;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;

class NewsController extends \site\classes\Controller {
    public $menuSection = 'news';

    public function setActiveCategory($slug) {
        foreach ($this->view->params['activeSection']['items'] as $index => $item) {
            if ($item['slug'] == $slug) {
                $this->view->params['activeSection']['items'][$index]['active'] = true;
                break;
            }
        }
    }

    public function actionIndex($slug = null) {
        if ($slug) {
            $parts = explode('/', $slug);

            $this->setActiveCategory($parts[0]);

            $category = NewsCategory::find();

            if ($parts[1]) {
                    $category->from('NewsCategory as category')
                    ->joinWith('parent as parent')
                    ->where([
                        'parent.slug' => $parts[0],
                        'category.slug' => $parts[1]
                    ]);
            } else {
                $category->where(['slug' => $parts[0]]);
            }

            $category = $category->one();
            if (!$category) {
                throw new NotFoundHttpException();
            }

            $news = $category->newsRecursive;
        } else {
            $category = null;
            $news = News::find()->orderBy(['created' => SORT_DESC])->all();
        }



        return $this->render('category', [
            'slug' => $slug,
            'category' => $category,
            'news' => $news
        ]);
    }

    public function actionNews($slug) {
        $parts = explode('/', $slug);

        $this->setActiveCategory($parts[0]);

        $news = News::find();
        $news->from('news as news');
        $news->joinWith('category as cat1');

        if ($parts[2]) {
            $news->joinWith('category.parent as cat2');
            $news->where([
                'cat1.slug' => $parts[0],
                'cat2.slug' => $parts[1],
                'news.slug' => $parts[2]
            ]);
        } else {
            $news->where([
                'cat1.slug' => $parts[0],
                'news.slug' => $parts[1]
            ]);
        }

        $news = $news->one();

        $news->textFull = str_replace('[[img]]', Html::img($news->imageUrl, ['class' => 'full-width']), $news->textFull);

        return $this->render('news', ['news' => $news]);
    }
}