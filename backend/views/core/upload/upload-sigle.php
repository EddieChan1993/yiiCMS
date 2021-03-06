<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/20
 * Time: 16:29
 */

use yii\helpers\Url;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Page form example - Fileuploader</title>
    <!-- styles -->
    <link href="<?=Url::to('@web/alpha/plugins/edd-upload-sdk/src/jquery.fileuploader.css')?>" media="all" rel="stylesheet">
    <link href="<?=Url::to('@web/alpha/plugins/edd-upload-sdk/examples/single_file/css/jquery.fileuploader-theme-thumbnails.css')?>" media="all" rel="stylesheet">
    <!-- js -->
    <script src="<?=Url::to('@web/alpha/plugins/edd-upload-sdk/src/jquery.fileuploader.min.js')?>" type="text/javascript"></script>
    <script src="<?=Url::to('@web/alpha/plugins/edd-upload-sdk/examples/single_file/js/custom.js')?>" type="text/javascript"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            font-size: 14px;
            line-height: normal;
            color: #47525d;
            background-color: #fff;

            margin: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        form {
            padding: 15px;
            background: #f5f6fA;
        }

        label {
            font-weight: bold;
            display: block;
        }

        input[type="text"],
        input[type="email"] {
            padding: 6px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<form action="<?= Url::to(['core/upload/upload-single'])?>" method="post" enctype="multipart/form-res">
    <input type="text" value="<?=$path?>" hidden name="path">
    <input type="file" name="files">
    <div class="col-xs-12">
        <button class="btn btn-info btn-block" type="submit">上传</button>
    </div>
</form>
<script src="<?=Url::to('@web/alpha/plugins/edd-upload-sdk/ajaxForm.js')?>" crossorigin="anonymous"></script>
<script type="text/javascript">
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    var type = "{$type}";//文件类型
    var src = '';

    $('form').ajaxForm({
        beforeSubmit: showRequest,
        success:showResponse2
    });
    function showRequest() {
        m_loading('图片上传中,请稍后...',{
            time:-1
        })
    }
    function showResponse2(res) {
        destory();
        if (res.error==0) {
            m_success('图片上传成功^_^', {
                time: 500,
            },function () {
                parent.$('#<?=$dom?>').val(res.msg);
                if(type=='file') {
                    //如果是文档
                    src = "<?=Url::to('@web/upload/admin/common/file.png')?>";
                }else{
                    //如果是图片
                    src = res.msg;
                }
                parent.$('#<?=$dom?>').siblings('img').attr('src', src);
                parent.layer.close(index);
            })
        } else {
            m_error(res.msg);
        }
    }
</script>
</body>
</html>
