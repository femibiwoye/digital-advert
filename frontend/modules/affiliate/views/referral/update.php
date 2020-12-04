<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Options */

$this->title = Yii::t('app', 'Update Referral: {code}', [
    'name' => $model->code,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Referral'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['view', 'id' => $model->code]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="options-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
