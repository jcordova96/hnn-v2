<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>

<h1>Login</h1>

<div class="row">
    <div class="span6">
        <p>Please fill out the following form with your login credentials:</p>

        <div class="form">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'login-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
            )); ?>

            <p class="note">Fields with <span class="required">*</span> are required.</p>

            <div class="row">
                <div class="span6">
                    <?php echo $form->labelEx($model, 'username'); ?>
                    <?php echo $form->textField($model, 'username'); ?>
                    <?php echo $form->error($model, 'username'); ?>
                </div>
            </div>

            <div class="row">
                <div class="span6">
                    <?php echo $form->labelEx($model, 'password'); ?>
                    <?php echo $form->passwordField($model, 'password'); ?>
                    <?php echo $form->error($model, 'password'); ?>
                </div>
            </div>

            <div class="row rememberMe">
                <div class="span6">
                    <?php echo $form->checkBox($model, 'rememberMe'); ?>
                    <?php echo $form->label($model, 'rememberMe'); ?>
                    <?php echo $form->error($model, 'rememberMe'); ?>
                </div>
            </div>

            <div class="row buttons">
                <div class="span6">
                    <?php echo CHtml::submitButton('Login'); ?>
                </div>
            </div>

            <?php $this->endWidget(); ?>
        </div>
        <!-- form -->
    </div>
</div>
