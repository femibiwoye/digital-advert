<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Banks */

$this->title = 'Create Banks';
$this->params['breadcrumbs'][] = ['label' => 'Banks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banks-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
