<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

//$this->pageTitle = Yii::$app->name . ' - Login';
//$this->breadcrumbs = array(
//    'Login',
//);
?>

<h1>Login</h1>

<div class="row">
    <div class="span6">
        <p>Please fill out the following form with your login credentials:</p>

        <div class="form">
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'enableClientValidation' => true,
//                'clientOptions' => array(
//                    'validateOnSubmit' => true,
//                ),
            ]); ?>

            <p class="note">Fields with <span class="required">*</span> are required.</p>

            <div class="row">
                <div class="span6">
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="span6">
                    <?= $form->field($model, 'password')->passwordInput() ?>
                </div>
            </div>

            <div class="row rememberMe">
                <div class="span6">
                    <?= $form->field($model, 'rememberMe')->checkbox() ?>
                </div>
            </div>

            <div class="row buttons">
                <div class="span6">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>

            <?php ActiveForm::end() ?>
        </div>
        <!-- form -->
    </div>
</div>
