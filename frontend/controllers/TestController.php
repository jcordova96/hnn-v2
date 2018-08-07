<?php

namespace frontend\controllers;

use app\models\Blog;
use app\models\Tag;
use yii\web\Controller;
use app\models\Article;

class TestController extends Controller
{
    public function actionTest1() {

        $data = Tag::getNodesByTagId(238);
        var_dump($data);

    }
}
