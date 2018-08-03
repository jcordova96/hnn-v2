<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Jobpost */

$this->title = 'Update Jobpost: ' . $model->ixJobPost;
$this->params['breadcrumbs'][] = ['label' => 'Jobposts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ixJobPost, 'url' => ['view', 'id' => $model->ixJobPost]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jobpost-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
