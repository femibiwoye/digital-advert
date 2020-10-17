<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-view">

    <?php $this->beginBlock('content-header');
    echo Html::encode($this->title);
    $this->endBlock(); ?>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?php
        if (Yii::$app->user->identity->level == 'super') {
            echo Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);
        } ?>
    </p>

    <?php

    function image($image)
    {
        if (empty($image)) {
            return '@web/img/user-icon.png';
        } else {
            return '@web/img/admin/' . $image;
        }
    }

    function status($status)
    {
        if ($status == 10) {
            return 'Active';
        } else {
            return 'Inactive';
        }
    }

    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'name',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            [
                'attribute' => 'status',
                'value' => status($model->status),
            ],
            'position',
            [
                'attribute' => 'image',
                'value' => image($model->image),
                'format' => ['image', ['width' => '100', 'height' => '100']],
            ],
            'level',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
