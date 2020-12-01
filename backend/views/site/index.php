<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Dashboard';
$bg = ['aqua', 'green', 'yellow', 'red', 'blue', 'orange', 'purple', 'black', 'gray', 'info', 'maroon', 'olive', 'navy', 'teal', 'primary', 'success']
?>



        <div class="row">
            <?php foreach ($analytics as $i => $data) {

                ?>
                <div class="col-sm-3 col-xs-12">
                    <a href="<?= Url::to($data['url']) ?>">
                        <div class="small-box bg-<?= $bg[mt_rand(0, 15)] ?>">
                            <div class="inner">
                                <h3>
                                    <?= $data['number'] ?>
                                </h3>
                                <p>
                                    <?= $data['title'] ?>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>

        </div>
