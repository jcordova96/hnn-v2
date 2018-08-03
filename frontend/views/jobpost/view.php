<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Jobpost */

$this->title = $model->ixJobPost;
$this->params['breadcrumbs'][] = ['label' => 'Jobposts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jobpost-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ixJobPost], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ixJobPost], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ixJobPost',
            'user_id',
            'sSource',
            'sLocation',
            'sGeneralStartDate',
            'sSalaryDescription:ntext',
            'sRequirements:ntext',
            'sBenefits',
            'sDescription:ntext',
            'sTitle',
            'sEmployerName',
            'sContactEmail:email',
            'sUrl',
            'sUrlExternal',
            'sApplicationUrl',
            'dtPosted',
            'dtExpire',
            'sAddress',
            'sStateProvince',
            'sCity',
            'ixCountry',
            'fVerified',
            'fActive',
        ],
    ]) ?>

</div>
