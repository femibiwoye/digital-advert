<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Referrer */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Referrer'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="referrer-view">

    <div class="content">
        <p>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->code], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->code], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this code?'),
                'method' => 'post',
            ],
        ]) ?>
        </p>


        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'code',
                // 'created_by',
                // 'updated_by',
                // 'created_at',
                // 'updated_at',
            ],
        ]) ?>
    </div>

</div>
