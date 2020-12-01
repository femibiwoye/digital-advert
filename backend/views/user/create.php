<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserModel */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'User Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-model-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
