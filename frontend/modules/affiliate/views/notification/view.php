<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Notification */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Notifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="notification-view">

    <div class="content">
        <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    
                    'title',
                    'description:ntext',
                    [
                        'label' => 'Sent Date',
                        'value' => 'created_at'
                    ],
                ],
            ]) ?>
    </div>

</div>
