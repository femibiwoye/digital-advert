<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Users */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="users-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'remember_token',
            'created_at',
            'updated_at',
            'is_admin',
            'wallet_balance',
            'verification_status',
            'name',
            'email:email',
            'email_verified_at:email',
            'phone_number',
            'password',
            'twitter_id',
            'username',
            'image_path',
            'auth_key',
            'phone',
            'status',
            'token:ntext',
            'affiliate_id',
            'state',
            'country',
            'about:ntext',
        ],
    ]) ?>

</div>
