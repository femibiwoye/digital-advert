<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Coupon */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="content">

    <div class="business-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'phone_number',
            'email',
            'created_at'
        ],
    ]) ?>

    </div>
</div>
