<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en" class="body-full-height">
<head>
    <!-- META SECTION -->
    <title>|后台登录</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!-- END META SECTION -->
    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="alpha/css/theme-default.css"/>
    <!-- EOF CSS INCLUDE -->
    <!--<script src="http://static.geetest.com/static/tools/gt.js"></script>-->
    <script src="//captcha.luosimao.com/static/js/api.js"></script>
    <link rel="stylesheet" href="alpha/plugins/message_alert/css/m_css.css">
    <script src="alpha/plugins/message_alert/js/m_js.js"></script>
    <script type="text/javascript" src="alpha/js/jquery-2.2.4.min.js"></script>
    <script src="alpha/plugins/ajax-form/ajax-form.js"></script>
    <style>
        .login-container{
            background: url(upload/admin/common/bg.jpg);
            background-size: cover;
        }
        /*  .login-container .login-box .login-logo {
              background: url({:get_options('site_logo')}) top center no-repeat;
               background-size: 130px;
          }*/
        .login-container .login-box .login-body{
            background: #334163
        }
    </style>
</head>
<body>
<?=$this->render('../../layouts/alert')?>
<div class="login-container">
    <div class="login-box animated bounceInDown">
        <div  class="login-logo animated bounceIn"></div>
        <div  class="login-body ">
            <div class="login-title animated fadeIn"><strong>欢迎使用</strong>, 请登录</div>
            <form open_verify="" id="login_in_form" action="<?=Url::to(['login-think'])?>" class="form-horizontal" method="post">
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
                &copy;2016- alphaCMS
            </div>
        </div>
    </div>
</div>
<script src="controller/login.js"></script>
</body>
</html>






