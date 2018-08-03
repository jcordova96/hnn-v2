<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Jobpost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jobpost-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'sSource')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sLocation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sGeneralStartDate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sSalaryDescription')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sRequirements')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sBenefits')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sDescription')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sTitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sEmployerName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sContactEmail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sUrl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sUrlExternal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sApplicationUrl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dtPosted')->textInput() ?>

    <?= $form->field($model, 'dtExpire')->textInput() ?>

    <?= $form->field($model, 'sAddress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sStateProvince')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sCity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ixCountry')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fVerified')->textInput() ?>

    <?= $form->field($model, 'fActive')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
