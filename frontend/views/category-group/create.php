<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CategoryGroup */

$this->title = 'Create Category Group';
$this->params['breadcrumbs'][] = ['label' => 'Category Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
