<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

$title = Yii::$app->params['title'];
$cms = Yii::$app->params['cms'];
?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?=$title?>|<?=$cms?></title>
    <link rel="icon" href="<?=Url::to('@web/upload/admin/common/logo.png')?>" type="image/x-icon" />
    <?=$this->render('head_out')?>
    <style type="text/css">
        html, body{
            overflow: hidden;
        }
    </style>
</head>
<body>
<div class="animated fadeIn page-container page-navigation-top-fixed">
    <?=$this->render('sidebar')?>
    <div class="page-content">
        <?=$this->render('nav')?>
        <iframe id="frame" width="100%" height="100%" src="<?= Url::to([$controller.'/'.$method])?>" frameborder="0"></iframe>
    </div>
</div>
<?=$this->render('alert')?>

<script type="text/javascript" src="<?=Url::to('@web/alpha/js/plugins/jquery/jquery.min.js')?>"></script>
<script type="text/javascript" src="<?=Url::to('@web/alpha/js/plugins/jquery/jquery-ui.min.js')?>"></script>
<script type="text/javascript" src="<?=Url::to('@web/alpha/js/plugins/bootstrap/bootstrap.min.js')?>"></script>
<!-- END PLUGINS -->
<!-- THIS PAGE PLUGINS -->
<script type='text/javascript' src='<?=Url::to('@web/alpha/js/plugins/icheck/icheck.min.js')?>'></script>
<script type="text/javascript" src="<?=Url::to('@web/alpha/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')?>"></script>
<!-- END PAGE PLUGINS -->
<!-- START TEMPLATE -->
<script type="text/javascript" src="<?=Url::to('@web/alpha/js/plugins.js')?>"></script>
<script type="text/javascript" src="<?=Url::to('@web/alpha/js/actions.js')?>"></script>
</body>
</html>
