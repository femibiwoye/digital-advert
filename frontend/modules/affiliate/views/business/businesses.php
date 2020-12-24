<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Payments;
use common\models\Settings;
use common\models\WalletHistories;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Invited Businesses');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="content">

    <div class="business-index">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'name',
                //'image_path',
                [
                    'label' => 'Amount Earned',
                    'value' => function ($model) {
                        return (Payments::find()->where(['user_id' => $model->id])->sum('amount') / 100) * Settings::findOne(['key_word' => 'user_share_point'])->value;
                    },
                ],
                'phone_number',
                'email',
                'twitter_id',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}'
                ],
            ],
        ]); ?>


    </div>
</div>

