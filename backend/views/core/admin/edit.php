<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/20
 * Time: 15:14
 */

use common\helps\FormW;
use yii\helpers\Url;

?>
<div class="panel panel-default">
    <form id="edit_form" action="<?= Url::to(['core/admin/edit'])?>" method="post" class="form-horizontal">
        <div class="panel-body">
            <input type="hidden" name="id" value="<?=$id?>">
            <div class="row">
                <div class="col-xs-10">
                    <div class="form-group">
                        <label class="col-xs-3 control-label">头像</label>
                        <div class="col-xs-6">
                            <?=FormW::SingleUpload('avatar',$avatar,'inp1')?>
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
                    <!--<div class="form-group">-->
                    <!--<label class="col-xs-3 control-label">邮箱</label>-->
                    <!--<div class="col-xs-9">-->
                    <!--<input name="user_email" value="{$user_email}" type="text" class="form-control"/>-->
                    <!--</div>-->
                    <!--</div>-->
                    <div class="form-group">
                        <label class="col-xs-3 control-label">角色</label>
                        <div class="col-xs-9">
                            <select name="role_id" class="form-control select">
                                <?php foreach ($role_list as $k=>$v){?>
                                    <option <?=is_selected($role_name,$v['name'])?> value="<?=$v['id']?>"><?=$v['name']?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3  control-label">管理员状态</label>
                        <div class="col-xs-9">
                            <label class="switch">
                                <input name="status" type="checkbox" <?=is_checked($user_status)?> value="1"/>
                                <span></span>
                            </label
                            <span class="help-block">默认正常</span>
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
