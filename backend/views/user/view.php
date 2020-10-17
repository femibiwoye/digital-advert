<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserModel */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-model-view">

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
            'username',
            'first_name',
            'middle_name',
            'last_name',
            'phone',
            'email:email',
            'image',
            'type',
            'wallet',
            'previous_wallet',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email_verified:email',
            'profile_verified',
            'status',
            'verification_token',
            'oauth_provider',
            'oauth_uid',
            'token',
            'token_expires',
            'last_accessed',
            'is_boarded',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
