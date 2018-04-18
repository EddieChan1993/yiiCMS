<?php
use \yii\helpers\Url;
?>
<!DOCTYPE html>
<div class="panel panel-default">
    <form id="edit_form" method="post" action="<?=Url::to(['core/edit'])?>" class="form-horizontal" role="form">
        <input type="hidden" value="<?=$id?>" name="id">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-11">
                    <div class="form-group">
                        <label class="col-xs-3 control-label">父级菜单</label>
                        <div class="col-xs-9">
                            <select name="parentid" class="form-control select">
                                <option  value="">作为父级</option>
                                <?php foreach ($menu_list as $k=>$v){?>
                                <option <?=is_selected($parentid,$v['id'])?> value="<?=$v['id']?>"><?=$v['lefthtml']?><?=$v['name']?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">菜单名称</label>
                        <div class="col-xs-9">
                            <input name="name" value="<?=$name?>" type="text" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">@控制器/方法</label>
                        <div class="col-xs-3">
                            <input name="controller" type="text" value="<?=$controller?>" class="form-control"/>
                            <span class="help-block">控制器</span>
                        </div>
                        <div class="col-xs-3">
                            <input value="<?=$method?>" name="method" type="text"  class="form-control"/>
                            <span class="help-block">若有子级菜单，填写default</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-3 control-label">菜单徽标</div>
                        <div class="col-xs-9">
                            <input value="<?=$icon?>" name="icon" type="text" class="form-control"/>
                            <span class="help-block">格式:fa fa-users</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">备注</label>
                        <div class="col-xs-9 col-xs-12">
                            <textarea name="remark" class="form-control" rows="5"><?=$remark?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">菜单类型</label>
                        <div class="col-xs-9">
                            <select name="type" class="form-control select">
                                <option <?=is_selected($type,0)?> value="0">菜单</option>
                                <option <?=is_selected($type,1)?> value="1">权限认证</option>
                            </select>
                            <span class="help-block">【菜单】显示在左边栏的内容</span>
                            <span class="help-block">【权限认证】仅作为功能，不显示</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3  control-label">菜单状态</label>
                        <div class="col-xs-9">
                            <label class="switch">
                                <input name="status" type="checkbox" <?=is_checked($status)?> value="1"/>
                                <span></span>
                            </label>
                            <span class="help-block">【默认正常】,若为菜单，则显示，若为功能，且加入权限里，生效</span>
                            <span class="help-block">【非正常】若为菜单，则不显示，若为功能，且加入权限里，不生效，</span>
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
