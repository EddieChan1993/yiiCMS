<?php

use common\helps\FormW;
use \yii\helpers\Url;
?>
<div class="panel panel-default">
    <form id="edit_form" action="<?=Url::to(['core/admin/edit-self'])?>" method="post" class="form-horizontal">
        <div class="panel-body">
            <input type="hidden" name="id" value="<?=$id?>">
            <div class="row">
                <div class="col-xs-10">
                    <div class="form-group">
                        <label class="col-xs-3 control-label">头像</label>
                        <div class="col-xs-6">
                            <div class="gallery">
                                <a class="gallery-item"  href="javascript:void('')" title="Space picture 2" data-gallery>
                                    <div style="width: 150px"  class="image" >
                                        <input value="<?=$avatar?>" hidden name="avatar" type="text" id="inp">
                                        <img src="<?=is_img($avatar)?>" alt="Space picture 2"/>
                                        <ul class="gallery-item-controls">
                                            <li onclick="upload_single('inp','avatar')"><i class="fa fa-cloud-upload"></i></li>
                                            <li onclick="del_pic('inp')"><i class="fa fa-times"></i></li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">登录名</label>
                        <div class="col-xs-9">
                            <?= FormW::Input('user_login',$user_login)?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">密码</label>
                        <div class="col-xs-9">
                            <?= FormW::Input('user_pass',null,'password')?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">确认密码</label>
                        <div class="col-xs-9">
                            <input name="confirm_pass"  type="password" class="form-control"/>
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
