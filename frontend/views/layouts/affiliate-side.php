<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="<?=Url::to(['/affiliate'])?>"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Businesses</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-arrow-right"></i><a href="<?= Url::to(['../affiliate/business/index']); ?>">All Businesses</a></li>
                        <li><i class="fa fa-arrow-right"></i><a href="<?= Url::to(['../affiliate/business/paid-business']); ?>">Paid Business</a></li>
                        <li><i class="fa fa-arrow-right"></i><a href="<?= Url::to(['../affiliate/business/unpaid-business']); ?>">Unpaid Business</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?=Url::to(['referral/index'])?>"> <i class="menu-icon ti-shortcode"></i>Referrers </a>
                </li>
                <li>
                    <a href="<?=Url::to(['notifications'])?>"> <i class="menu-icon ti-bell"></i>Notifications </a>
                </li>
                <li>
                    <a href="<?=Url::to(['profile/password'])?>"> <i class="menu-icon ti-settings"></i>Settings </a>
                </li>
                <li>
                    <?=Html::a('<i class="menu-icon ti-power-off"></i>Logout', Url::to(['/site/logout']), ['data-method' => 'POST']) ?>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
