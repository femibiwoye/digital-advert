<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BankList */

$this->title = 'Update Bank List: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Bank Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bank-list-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
