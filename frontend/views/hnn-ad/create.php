<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HnnAd */

$this->title = 'Create Hnn Ad';
$this->params['breadcrumbs'][] = ['label' => 'Hnn Ads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hnn-ad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
