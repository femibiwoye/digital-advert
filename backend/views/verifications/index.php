<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel common\models\VerificationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Verifications';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="verifications-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    Modal::begin([
        'header' => '<h4>Approve</h4>',
        'id' => 'modal',
        'size' => 'modal-lg',
    ]);

    echo "<div id='modalContent'></div>";
    Modal::end();
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'updated_at',
            'user.name',
            'verification_method',
            [
                'attribute' => 'verification_media',
                'value' => function ($model) {
                    return $model->verification_media;
                },
                'format' => ['image', ['height' => 100]],
            ],
            'created_at',
            //'status',
            //'verified_by',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{mybutton} {view} {approve} {disapprove} ',
                'buttons' => [
                        'mybutton' => function($url, $model) {     // render your custom button
                            $url = Url::to(['verifications/search', 'user_name'=> $model->user->name]);
                            return Html::a('<button class="btn btn-primary">Search</button>', $url, ['title' => 'search']);
                        },

                    'approve' => function ($url, $model) {
                        if ($model->status != 1) {
                            $url = Url::to(['verifications/approve', 'id' => $model->id]);
                            return Html::a('<span class="fa fa-thumbs-up"></span>', $url, ['title' => 'approve']);
                        }
                    },
                    'disapprove' => function ($url, $model) {
                        $url = Url::to(['verifications/decline', 'id' => $model->id]);
                        return Html::a('<span class="fa fa-thumbs-down"></span>', $url, ['title' => 'decline']);
                    },
                ]

            ],],
    ]); ?>


</div>

<?php
$script = <<< JS
    $(function() {
        $('#modalButton').click(function () {
            $('#modal').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'));
        });
    });
JS;

$this->registerJs($script);
?>
