<?php

use common\helps\FormW;
use \yii\helpers\Url;

?>
<div class="panel panel-default">
    <form id="edit_form_self" action="<?= Url::to(['core/admin/edit-self']) ?>" method="post" class="form-horizontal">
        <div class="panel-body">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="row">
                <div class="col-xs-10">
                    <div class="form-group">
                        <label class="col-xs-3 control-label">头像</label>
                        <div class="col-xs-6">
                            <?= FormW::SingleUpload('avatar', $avatar) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">登录名</label>
                        <div class="col-xs-9">
                            <?= FormW::Input('user_login', $user_login) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">密码</label>
                        <div class="col-xs-9">
                            <?= FormW::Input('user_pass', null, 'password') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">确认密码</label>
                        <div class="col-xs-9">
                            <input name="confirm_pass" type="password" class="form-control"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <button class="btn btn-info pull-right">保存修改<span class="fa fa-floppy-o fa-right"></span></button>
        </div>
    </form>
</div>

<script>
    //编辑提交处理
    $('#edit_form_self').ajaxForm({
        beforeSubmit: editRequest1,
        success: editResponse1
    });

    function editRequest1() {
        m_loading('数据提交中，请耐心等待...',{
            time:-1
        });
    }

    function editResponse1(res) {
        var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
        destory();
        if(res.error==0) {
            m_success(res.msg,{
                time:500
            },function () {
                parent.layer.close(index);
            })
        }else{
            m_error(res.msg);
        }
    }

</script>