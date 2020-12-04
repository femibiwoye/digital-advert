<?php
/**
 * Created by PhpStorm.
 * User: Femiparadise
 * Date: 12/10/2016
 * Time: 2:29 PM
 */

use yii\helpers\Url;

$user = Yii::$app->user->identity;
$image = !empty($user->image_path) ? Url::to($user->image_path) : Url::to('@web/img/users/user.png');
?>


<link rel="stylesheet" href="<?= Url::to('@web/cropper/') ?>dist/cropper.min.css">
<link rel="stylesheet" href="<?= Url::to('@web/cropper/') ?>cropper/css/main.css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<div class="container" id="crop-avatar">

    <!-- Current avatar -->

        <div class="user_profile_details">
            <div class="user_info_avi avi_xl" title="Change picture">
                <img src="<?= $image ?>" id="target"/>
                <span class="default_avi"><?= strtoupper("{$user->name}") ?></span>
            </div>
            <div class="user_details_wrapper">

<!--                <div class="user_info">-->
<!--                    <h5 class="title font-bold">Change Photo</h5>-->
<!--                    <span class="font-sm">Accepts .png, .jpg or .jpeg</span>-->
<!--                </div>-->
                <div class="profile_action_btn">
                    <label class="btn btn-primary btn-sm avatar-view-opener">
                        <span>Change Photos</span>
                    </label>
                </div>
            </div>
        </div>



    <div class="modal " id="avatar-modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form class="avatar-form" action="<?= Url::to('@web/') ?>cropper/cropper/crop.php"
                      enctype="multipart/form-data" method="post">
                    <header class="modal-header">
                        <h4 class="modal-title text-caps">Crop your Image</h4>
                        <div class="dialogDismiss">
                            <button type="button" class="close_dialog" data-dismiss="modal"></button>
                        </div>
                    </header>
                    <div class="modal-body">
                        <div class="avatar-body">
                            <div class="margin_bottom_md">
                                <input type="hidden" name="user" value="<?= Yii::$app->user->id; ?>">
                                <input type="hidden" name="fileString"
                                       value="<?= substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'), 0, 30) ?>">
                                <input type="hidden" class="avatar-src" name="avatar_src">
                                <input type="hidden" class="avatar-data" name="avatar_data">

                                <label for="avatarInput" class="btn btn-primary btn-sm">
                                    <input type="file" accept=".png, .jpg, .jpeg" name="avatar_file" id="avatarInput"
                                           hidden="" class="inputfile avatar-input">
                                    <span>Change Image</span>
                                </label>
                            </div>
                            <div class="avatar-wrapper"></div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-secondary">Done</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
</div>

<script src="<?= Url::to('@web/cropper/') ?>assets/js/jquery.min.js"></script>
<script src="<?= Url::to('@web/cropper/') ?>assets/js/bootstrap.min.js"></script>
<script src="<?= Url::to('@web/cropper/') ?>dist/cropper.min.js"></script>
<script src="<?= Url::to('@web/cropper/') ?>cropper/js/main.js"></script>

