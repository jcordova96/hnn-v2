<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HnnAd */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hnn-ad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'slot')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ad_code')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'modified')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
