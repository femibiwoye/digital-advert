<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Checkouts */

$this->title = 'Create Checkouts';
$this->params['breadcrumbs'][] = ['label' => 'Checkouts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkouts-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
