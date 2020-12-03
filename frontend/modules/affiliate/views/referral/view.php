<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Referrer */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Referrer'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="referrer-view">

    <div class="content">
        <p>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->code], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->code], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this code?'),
                'method' => 'post',
            ],
        ]) ?>
        </p>


        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'code',
                // 'created_by',
                // 'updated_by',
                // 'created_at',
                // 'updated_at',
            ],
        ]) ?>

    <?php

        $this->title = Yii::t('app', 'Businesses Invited using this code');
        echo "<br><h3>" . $this->title . "</h3>";
        ?>


            <div class="business-index">
                
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'name',
                        'phone_number',
                        'email',
                        'twitter_id',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view}',
                            'buttons' => [
                                'view' => function($url, $model, $key) {     // render your custom button                            
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', 
                                    ['../affiliate/business/view', 'id'=>$model->id]);
                                }
                            ]
                        ],
                    ],
                ]); ?>

</div>
</div>

    </div>

</div>
