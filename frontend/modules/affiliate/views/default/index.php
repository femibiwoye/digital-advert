<?php

/* @var $this yii\web\View */

use yii\web\View;

$this->title = 'BE MOTIVATED TO ENGAGE';
?>
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!-- Widgets  -->
        <div class="row">
            <?php foreach ($dashboard as $data){?>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-<?=mt_rand(0,5)?>">
                                <i class="pe-7s-<?=$data['icon']?>"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><?=$data['sign']?><span class="count"><?=$data['count']?></span></div>
                                    <div class="stat-heading"><?=$data['title']?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <!-- /Widgets -->
    </div>
    <!-- .animated -->
</div>