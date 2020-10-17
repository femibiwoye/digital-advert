<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Admin */

$this->title = 'Create Admin';
$this->params['breadcrumbs'][] = ['label' => 'Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="app-inner-layout__content">
    <div class="tab-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div class="tracks-view">

                                <div class="admin-create">

                                    <?php $this->beginBlock('content-header');
                                    echo Html::encode($this->title);
                                    $this->endBlock(); ?>

                                    <?= $this->render('_create', [
                                        'model' => $model,
                                    ]) ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>