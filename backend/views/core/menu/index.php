<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/17
 * Time: 19:45
 */
use common\helps\FormW;
use yii\helpers\Url;
$title = $this->params['title'];
$tab_1 = $this->params['tab_1'];
$tab_2 = $this->params['tab_2'];
?>
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"><?=$title?></span></h2>
</div>
<div class="row animated fadeIn">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="<?=!empty($menuChild)?'':'active'?>"><a href="#tab-first" role="tab" data-toggle="tab"><?=$tab_1?>
                            <button class="btn btn-success btn-rounded btn-sm"><?=$menu_nums?></button>
                        </a></li>
                    <li class="<?=!empty($menuChild)?'active':''?>""><a href="#tab-second" role="tab" data-toggle="tab"><?=$tab_2?></a></li>
                </ul>
                <div class="panel-body tab-content">
                    <div class="tab-pane <?=!empty($menuChild)?'':'active'?>" id="tab-first">
                        <table  class="demo1 table datatable table-hover">
                            <thead>
                            <tr>
                                <th>菜单名称</th>
                                <th>功能结构</th>
                                <!--<th>类型</th>-->
                                <th>状态</th>
                                <th>图标</th>
                                <th>排序</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($menu_list as $k=>$v){ ?>
                            <tr class="del_tr">
                                <td><?=$v['lefthtml']?><?=menu_type($v['name'],$v['type'])?></td>
                                <td>@<?=$v['controller']?>/<?=$v['method']?></td>
                                <td><?=is_stop($v['status'])?></td>
                                <td><i class="<?=$v['icon']?>"></i></td>
                                <td><input onchange="change_order(this)" style="width: 70px" type="number" class="order_change form-control" data-url="<?= Url::to(['core/menu/update-order'])?>" pk-id="<?=$v['id']?>" value="<?=$v['listorder']?>"></td>
                                <td>
                                    <a href="<?=Url::to(['core/menu/index','id'=>$v['id']])?>" class="btn btn-primary btn-rounded btn-sm"><span class="fa fa-plus"></span></a>
                                    <a title="<?=$v['name']?>【编辑】" data-url="<?=Url::to(['core/menu/edit-page','id'=>$v['id']])?>" onclick="edit_row(this)" class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></a>
                                    <button onClick="delete_row(this);" data-url="<?=Url::to(['core/menu/del','id'=>$v['id']])?>" class="btn btn-danger btn-rounded btn-sm" ><span class="fa fa-trash-o"></span></button>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane <?=!empty($menuChild)?'active':''?>" id="tab-second">
                        <form id="add_form" action="<?=Url::to(['core/menu/add'])?>" method="post" class="form-horizontal">
                            <div class="alert alert-info" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <strong>温馨提醒!</strong> 如果添加菜单没有控制器、方法,统一填写<span class="label label-default">default</span>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">父级菜单</label>
                                            <div class="col-md-9">
                                                <select name="parentid" class="form-control select">
                                                    <option  value="0">作为父级</option>
                                                    <?php foreach ($menu_list as $k=>$v){ ?>
                                                        <?php if(!empty($menuChild)){?>
                                                             <option <?=is_selected($menuChild,$v['id'])?> value="<?=$v['id']?>"><?=$v['lefthtml']?><?=$v['name']?></option>
                                                            <?php }else{?>
                                                              <option  value="<?=$v['id']?>"><?=$v['lefthtml']?><?=$v['name']?></option>
                                                            <?php }?>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">菜单名称</label>
                                            <div class="col-md-9">
                                                <?=FormW::Input('name')?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">@控制器/方法</label>
                                            <div class="col-xs-3">
                                                <?=FormW::Input('controller')?>
                                                <span class="help-block">控制器,若有子级菜单，则选择Default</span>
                                            </div>
                                            <div class="col-md-3">
                                                <?=FormW::Input('method')?>
                                                <span class="help-block">若有子级菜单，填写default</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-3 control-label">菜单徽标</div>
                                            <div class="col-md-9">
                                                <?=FormW::Input('icon')?>
                                                <span class="help-block">格式:fa fa-users</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">备注</label>
                                            <div class="col-md-9 col-xs-12">
                                                <?=FormW::TextArea('remark')?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">菜单类型</label>
                                            <div class="col-md-9">
                                                <?=FormW::Select('type',["菜单","权限认证"])?>
                                                <span class="help-block">【菜单】显示在左边栏的内容</span>
                                                <span class="help-block">【权限认证】仅作为功能，不显示</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3  control-label">菜单状态</label>
                                            <div class="col-md-9">
                                                <label class="switch">
                                                    <input name="status" type="checkbox" checked value="1"/>
                                                    <span></span>
                                                </label>
                                                <span class="help-block">【默认正常】,若为菜单，则显示，若为功能，且加入权限里，生效</span>
                                                <span class="help-block">【非正常】若为菜单，则不显示，若为功能，且加入权限里，不生效，</span>                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button class="btn btn-info pull-right">保存添加<span class="fa fa-floppy-o fa-right"></span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.demo1').dataTable({
        order:[]
    });
    function change_order(dom) {
        $.post($(dom).attr('data-url'),{
            id:$(dom).attr('pk-id'),
            listorder:$(dom).val()
        },function (res) {
            parent.destory();
            if(res.code){
                parent.m_success(res.msg)
            }else{
                parent.m_error(res.msg)
            }
        })
    }
</script>
