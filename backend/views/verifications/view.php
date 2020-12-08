<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Verifications */

$this->title = $model->user->name;
$this->params['breadcrumbs'][] = ['label' => 'Verifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="verifications-view">

    <p>
        <?php //= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'created_at',
            'updated_at',
            'user.name',
            'verification_method',
            [
                'attribute' => 'verification_media',
                'value' => $model->verification_media,
                'format' => ['image', ['height' => '200']],
            ],
            'status',
            'admin.username',
        ],
    ]) ?>

</div>
