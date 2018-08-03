<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BlogAuthor */

$this->title = 'Create Blog Author';
$this->params['breadcrumbs'][] = ['label' => 'Blog Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-author-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
