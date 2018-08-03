<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jobposts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jobpost-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Jobpost', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ixJobPost',
            'user_id',
            'sSource',
            'sLocation',
            'sGeneralStartDate',
            //'sSalaryDescription:ntext',
            //'sRequirements:ntext',
            //'sBenefits',
            //'sDescription:ntext',
            //'sTitle',
            //'sEmployerName',
            //'sContactEmail:email',
            //'sUrl',
            //'sUrlExternal',
            //'sApplicationUrl',
            //'dtPosted',
            //'dtExpire',
            //'sAddress',
            //'sStateProvince',
            //'sCity',
            //'ixCountry',
            //'fVerified',
            //'fActive',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
