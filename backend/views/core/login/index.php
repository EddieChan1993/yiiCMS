<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$cms = Yii::$app->params['cms'];
$title = Yii::$app->params['title'];

?>
<!DOCTYPE html>
<html lang="en" class="body-full-height">
<head>
    <!-- META SECTION -->
    <title><?= $title ?>|<?= $cms ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" href="<?= Url::to('@web/upload/admin/common/iron_man_2.png') ?>" type="image/x-icon"/>
    <!-- END META SECTION -->
    <!-- CSS INCLUDE -->
    <?= Html::cssFile('@web/alpha/css/theme-default.css') ?>
    <!-- EOF CSS INCLUDE -->
    <!--<script src="http://static.geetest.com/static/tools/gt.js"></script>-->
    <script src="//captcha.luosimao.com/static/js/api.js"></script>
    <?= Html::cssFile('@web/alpha/plugins/message_alert/css/m_css.css') ?>
    <?= Html::jsFile('@web/alpha/plugins/message_alert/js/m_js.js') ?>
    <?= Html::jsFile('@web/alpha/js/jquery-2.2.4.min.js') ?>
    <?= Html::jsFile('@web/alpha/plugins/ajax-form/ajax-form.js') ?>
    <style>
        .login-container {
            background: url(<?=Url::to('@web/upload/admin/common/bg.jpg')?>);
            background-size: cover;
        }

        /*  .login-container .login-box .login-logo {
              background: url({:get_options('site_logo')}) top center no-repeat;
               background-size: 130px;
          }*/
        .login-container .login-box .login-body {
            background: #334163
        }
    </style>
</head>
<body>
<?= $this->render('../../layouts/alert') ?>
<div class="login-container">
    <div class="login-box animated bounceInDown">
        <div class="login-logo animated bounceIn"></div>
        <div class="login-body ">
            <div class="login-title animated fadeIn"><strong>欢迎使用</strong>, 请登录</div>
            <?php $is_open_verify = Yii::$app->params['open_luosimao'] ?>
            <form open_verify="<?= YII_ENV ?>" is_open_verify="<?= $is_open_verify ?>" id="login_in_form"
                  action="<?= Url::to(['login-think']) ?>" class="form-horizontal" method="post">
                <div class="form-group">
                    <div class="col-md-12">
                        <input name="username" type="text" class="form-control" placeholder="用户名"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input name="password" type="password" class="form-control" placeholder="密码"/>
                    </div>
                </div>
                <?php if (YII_ENV == 'prod' && $is_open_verify) { ?>
                    <?php $params = Yii::$app->params['luosimao'] ?>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="l-captcha" data-width='100%'
                                 data-site-key="<?= ArrayHelper::getValue($params, 'SITE_KEY') ?>"></div>
                        </div>
                    </div>
                <?php } ?>
                <div class="form-group">
                    <div class="col-md-12">
                        <button id="embed-submit" class="btn btn-info btn-block">登陆</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="login-footer">
            <div class="pull-left">
            </div>
            <div class="pull-right animated bounceIn">
                &copy;2016-<?= date("Y") ?>&nbsp;<?= $cms ?>
            </div>
        </div>
    </div>
</div>
<?= Html::jsFile('@web/controller/login.js') ?>
</body>
</html>






