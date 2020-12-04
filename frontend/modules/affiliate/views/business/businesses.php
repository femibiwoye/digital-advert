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

                        $amount = WalletHistories::find()->alias('wh')
                            ->innerJoin('posts p','p.id = wh.reference_id')
                            ->innerJoin('users u','u.id = p.user_id')
                        ->where([
                            'wh.user_id' => Yii::$app->user->id,
                            'wh.reference_type' => 'ad',
                            'u.affiliate_id'=>Yii::$app->user->id
                            ])
                        ->sum('amount');

                        return $amount; // ? $amount->new_balance : '0.00';
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

