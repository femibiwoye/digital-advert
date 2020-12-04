<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WalletHistories */

$this->title = 'Create Wallet Histories';
$this->params['breadcrumbs'][] = ['label' => 'Wallet Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wallet-histories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
