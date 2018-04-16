<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'alpha/css/theme-default.css',
        'alpha/plugins/message_alert/css/m_css.css',
        'alpha/plugins/message_alert/js/m_js.js',
        'alpha/css/bootstrap/bootstrap.min.css',
    ];
    public $js = [
        'alpha/js/plugins/jquery/jquery.min.js',
        'alpha/plugins/layer-v3.0.1/layer/layer.js',
        'controller/silder.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
