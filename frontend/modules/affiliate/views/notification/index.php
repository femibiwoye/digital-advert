<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NotificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notifications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-index">


    <div class="content">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'title',
                //'description:ntext',
                //'generality',
                //'created_at',

                ['class' => 'yii\grid\ActionColumn',

                    'template' => '{view}'
                ],
            ],
        ]); ?>
    </div>

</div>
