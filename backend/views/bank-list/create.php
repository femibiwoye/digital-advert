<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BankList */

$this->title = 'Create Bank List';
$this->params['breadcrumbs'][] = ['label' => 'Bank Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bank-list-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
