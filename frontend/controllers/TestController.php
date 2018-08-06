<?php

namespace frontend\controllers;

use yii\web\Controller;
use app\models\Article;

class TestController extends Controller
{
    public function actionTest1() {

        $data = Article::getArticleByCategoryGroup(3);
        var_dump($data);

    }
}
