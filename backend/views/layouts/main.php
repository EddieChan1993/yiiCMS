<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" href="upload/admin/common/logo.png" type="image/x-icon" />
    <?php $this->head() ?>
    <style type="text/css">
        html, body{
            overflow: hidden;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>
<?=$this->params['data']?>
<div class="animated fadeIn page-container page-navigation-top-fixed">
    <div class="page-content">
        <?=$this->render('nav')?>
        <iframe id="frame" width="100%" height="99%" src="" frameborder="0"></iframe>
    </div>
</div>
<?php $this->endBody() ?>
<?=$this->render('alert')?>
<script type="text/javascript" src="alpha/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="alpha/js/plugins/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="alpha/js/plugins/bootstrap/bootstrap.min.js"></script>
<!-- END PLUGINS -->
<!-- THIS PAGE PLUGINS -->
<script type='text/javascript' src='alpha/js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="alpha/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<!-- END PAGE PLUGINS -->
<!-- START TEMPLATE -->
<script type="text/javascript" src="alpha/js/plugins.js"></script>
<script type="text/javascript" src="alpha/js/actions.js"></script>
</body>
</html>
<?php $this->endPage() ?>
