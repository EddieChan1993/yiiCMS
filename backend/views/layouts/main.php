<?php

use backend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <?php $this->head() ?>
    <?=$this->render('head_in')?>
</head>
<body>
<?php $this->beginBody() ?>
<?=$this->render('alert')?>
<div class="page-container">
    <div class="page-content">
        <!-- START BREADCRUMB -->
        <!-- <ul class="breadcrumb push-down-0">
             <li><a href="#">Home</a></li>
             <li><a href="#">Layouts</a></li>
             <li class="active">Frame Right Column</li>
         </ul>-->
        <!-- END BREADCRUMB -->

        <!-- START CONTENT FRAME -->

        <!-- START CONTENT FRAME TOP -->

        <!-- END CONTENT FRAME TOP -->

        <div class="content-frame-body content-frame-body-left">
            <?= $content ?>
        </div>
        <!-- START CONTENT FRAME BODY -->

        <!-- END CONTENT FRAME BODY -->
        <!-- END CONTENT FRAME -->
    </div>
</div>
<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage() ?>
