<?php
use common\helps\FormW;
use \yii\helpers\Url;
?>
<!DOCTYPE html>
<div class="panel panel-default">
    <form id="edit_form" method="post" action="<?=Url::to(['core/menu/edit'])?>" class="form-horizontal" role="form">
        <input type="hidden" value="<?=$id?>" name="id">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-11">
                    <div class="form-group">
                        <label class="col-xs-3 control-label">父级菜单</label>
                        <div class="col-xs-9">
                            <select name="parentid" class="form-control select">
                                <option  value="0">作为父级</option>
                                <?php foreach ($menu_list as $k=>$v){?>
                                    <option <?=is_selected($parentid,$v['id'])?> value="<?=$v['id']?>"><?=$v['lefthtml']?><?=$v['name']?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">菜单名称</label>
                        <div class="col-xs-9">
                            <?=FormW::Input('name',$name)?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">@控制器/方法</label>
                        <div class="col-xs-9">
                            <?=FormW::Input('controller',$controller)?>
                            <span class="help-block">【控制器】,若有子级菜单，则填default</span>
                            <?=FormW::Input('method',$method)?>
                            <span class="help-block">【方法】，若有子级菜单，填写default</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-3 control-label">菜单徽标</div>
                        <div class="col-xs-9">
                            <?=FormW::Input('icon',$icon)?>
                            <span class="help-block">格式:<a target="_blank" class="label label-warning" href="http://www.bootcss.com/p/font-awesome/">地址</a></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">备注</label>
                        <div class="col-xs-9 col-xs-12">
                            <?=FormW::TextArea('remark',$remark)?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">菜单类型</label>
                        <div class="col-xs-9">
                            <?=FormW::Select('type',["菜单","权限认证"],$type)?>

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
