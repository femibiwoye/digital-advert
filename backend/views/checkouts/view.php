<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Checkouts */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Checkouts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="checkouts-view">

    <p>
        <?php if($model->approval_status != 1){?>
        <?php //= Html::a('Approve', ['approve', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?php }?>
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
            'created_at',
            'updated_at',
            'user.name',
            'amount',
            'current_balance',
            'message',
            'admin.username',
            'preferred_choice',
            'approval_status',
        ],
    ]) ?>

<table class="table table-bordered table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">username</th>
      <th scope="col">Amount</th>
      <th scope="col">Type</th>
    </tr>
  </thead>
  
  <tbody>
  <?php if(isset($preferred_choice->user)){?>
    <tr>
      <th scope="row">1</th>
      <td><?=$preferred_choice->user->name ?></td>
      <td><?=$preferred_choice->amount ?></td>
      <td><?=$preferred_choice->type ?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>


</div>
