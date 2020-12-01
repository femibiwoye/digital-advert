<?php
use yii\helpers\Html;
use yii\helpers\Url;
$user = Yii::$app->user->identity;
?>
<header class="main-header">

    <?= Html::a('<span class="logo-lg"><img src="'.Url::to('@web/img/moreRave-white-logo.svg').'"></span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php
                        if(!empty($user->image)){
                            echo Html::img('@web/img/admin/'.$user->image,
                                ['class'=>'user-image', 'alt'=>$user->username]);
                        }else{
                            echo '<img src="'.Url::to('@web/img/user-icon.png').'" class="user-image"
                            alt="'.$user->username.'"/>';
                        }
                        ?>
                        <span class="hidden-xs"><?=$user->username?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <?php
                            if(!empty($user->image)){
                                echo Html::img('@web/img/admin/'.$user->image,
                                    ['class'=>'img-circle', 'alt'=>$user->username]);
                            }else{
                                echo '<img src="'.Url::to('@web/img/user-icon.png').'" class="img-circle"
                                alt="'.$user->username.'"/>';
                            }
                            ?>

                            <p>
                                <?=$user->username.' - '.$user->position?>
                                <small>Member since <?=date("M Y", $user->created_at)?></small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <?= Html::a(
                                    'Profile',
                                    ['/admin/view?id='.$user->id],
                                    ['data-method' => 'post','class'=>'btn btn-default btn-flat']
                                ) ?>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post','class'=>'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>
