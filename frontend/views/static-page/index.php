<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Static Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="static-page-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Static Page', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'slug',
            'content:ntext',
            'modified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
