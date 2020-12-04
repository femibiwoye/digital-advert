<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\WalletHistories;

/* @var $this yii\web\View */
/* @var $model backend\models\Coupon */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$amount = WalletHistories::find()->alias('wh')->innerJoin('posts p')
                    ->where([
                        'wh.user_id' => Yii::$app->user->id, 
                        'p.id' => 'wh.reference_id', 
                        'wh.reference_type' => 'ad'
                        ])
                    ->one();

?>


<div class="content">

    <div class="business-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'attribute' => 'image',
                'value' =>  !empty($model->image_path)? $model->image_path:null,
                'format' => ['image', ['height' => '200']],
            ],
            [
                'label' => 'Amount Earned',
                'value' => $amount ? $amount->new_balance : '0.00',
            ],
            'phone_number',
            'email',
            'created_at'
        ],
    ]) ?>

    </div>
</div>
