<?php

namespace site\controllers;

use app\models\News;
use app\models\NewsCategory;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;

class NewsController extends \site\classes\Controller {
    public function setBreadcrumbs($slug) {
        $this->view->params['breadcrumbs'] = $this->view->params['menu']['news'];

        foreach ($this->view->params['breadcrumbs']['items'] as $index => $item) {
            if ($item['slug'] == $slug) {
                $this->view->params['breadcrumbs']['items'][$index]['active'] = true;
                break;
            }
        }
    }

    public function actionIndex($slug = null) {
        if ($slug) {
            $this->breadcrumbs = $slug;

            $category = NewsCategory::findOne(['slug' => $slug]);

            if (!$category) {
                throw new NotFoundHttpException();
            }

            $news = $category->news;
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

        $this->breadcrumbs = $parts[0];

        $news = News::findOne(['slug' => $parts[1]]);
        if (!$news) {
            throw new NotFoundHttpException();
        }

        $content = $news->textFull;
        $content = str_replace('[[img]]', Html::img($news->imageUrl, ['class' => 'full-width']), $content);

        $helps = $news->textHelpArray;
        preg_match_all('/\[\[help\d+\]\]/', $content, $matches);
        if ($matches) {
            foreach ($matches[0] as $match) {
                preg_match('/\d+/', $match, $num);
                $num = $num[0] - 1;
                if ($helps[$num]) {
                    $content = str_replace($match, '<aside class="text-help"><div><h3>' . $helps[$num]['title'] . '</h3><p>' . $helps[$num]['text'] . '</p></div></aside>', $content);
                } else {
                    $content = str_replace($match, '', $content);
                }
            }
        }

        return $this->render('news', [
            'news' => $news,
            'content' => $content
        ]);
    }
}