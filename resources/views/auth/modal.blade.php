<?php

use System\Core\Model;
use System\Helpers\URL;

$lang = Model::get('\Application\Models\Language');
?>

<div class="modal fade" id="crop-avatar-modal" tabindex="-1" role="dialog" aria-labelledby="create-workshop-modal-label" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">

            <img id="image" src="" alt="Picture">

            <div class="container2">
                <div>

                </div>
                <p class="mt-2 align-center">
                    <button type="button" id="button" class="btn btn-primary"><?= $lang('save')?></button>
                </p>
            </div>


        </div>
    </div>
</div>
<define header_css>
    <style>
        .container2 {
            /*height: 387px;*/
            margin: 20px auto;
            max-width: 640px;
        }

        #image {
            max-width: 100%;
        }

        .cropper-container {
            margin: 20px auto;
        }

        .cropper-view-box,
        .cropper-face {
            border-radius: 50%;
        }

        /* The css styles for `outline` do not follow `border-radius` on iOS/Safari (#979). */
        /*.cropper-view-box {*/
        /*outline: 0;*/
        /*box-shadow: 0 0 0 1px #39f;*/
        /*}*/

        /*.cropper-container {*/
        /*width: 427px !important;*/
        /*height: 337px !important;*/
        /*}*/

        /*.cropper-wrap-box {*/
        /*width: 425px !important;*/
        /*height: 336px !important;*/
        /*}*/
    </style>
</define>