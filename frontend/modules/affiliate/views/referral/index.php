<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ReferrerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Referrals');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="referrer-index">

    <div class="content">
        <p>
            <?= Html::a(Yii::t('app', 'Create Referral Code'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'code',

                ['class' => 'yii\grid\ActionColumn','template' => '{view}'],
            ],
        ]); ?>
    </div>

</div>
