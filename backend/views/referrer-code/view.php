<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ReferrerCode */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Referrer Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="referrer-code-view">

    

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <button type="button" class="btn btn-success">
            Referral Count <span class="badge badge-light"><?=count($referral_count)?></span>
        </button>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user.name',
            'code',
            'created_at',
            'referralCount'
        ],
    ]) ?>

<table class="table table-bordered table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">username</th>
      <th scope="col">Affiliate ID</th>
      <th scope="col">Affiliate Code</th>
      <th scope="col">Created at</th>
    </tr>
  </thead>
  
  <tbody>
  <?php foreach ($referral_count as $referral){?>
    <tr>
      <th scope="row">1</th>
      
      <td><?=$referral->user->name ?></td>
      <td><?=$referral->affiliate_id ?></td>
      <td><?=$referral->affiliate_code ?></td>
      <td><?=$referral->created_at ?></td>

    </tr>
  <?php } ?>
  </tbody>
</table>
</div>
