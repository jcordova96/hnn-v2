<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blog Authors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-author-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Blog Author', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'uid',
            'author',
            'description:ntext',
            'active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
