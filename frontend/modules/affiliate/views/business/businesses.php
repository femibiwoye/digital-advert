<?php

use yii\helpers\Html;
use yii\grid\GridView;
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

                'name',
                'image_path',
                [
                    'label' => 'Amount Earned',
                    'value' => function($index, $model, $url){

                        $amount = WalletHistories::find()->alias('wh')->innerJoin('posts p')
                        ->where([
                            'wh.user_id' => Yii::$app->user->id, 
                            'p.id' => 'wh.reference_id', 
                            'wh.reference_type' => 'ad'
                            ])
                        ->one();

                        return $amount ? $amount->new_balance : '0.00'; 
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

