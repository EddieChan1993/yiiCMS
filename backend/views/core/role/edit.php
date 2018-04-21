<?php
use common\helps\FormW;
use \yii\helpers\Url;
?>
<link rel="stylesheet" type="text/css" href="alpha/plugins/check-tree/checktree.css" xmlns: xmlns:/>
<script type="text/javascript" src="alpha/plugins/check-tree/tree.js"></script>
<div class="panel panel-default">
    <form id="edit_form" action="<?=Url::to(['core/role/edit'])?>" method="post" class="form-horizontal">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-5">
                    <input type="hidden" name="id" value="<?=$id?>">
                    <div class="form-group">
                        <label class="col-xs-3 control-label">角色名称</label>
                        <div class="col-xs-9">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <?=FormW::Input('name',$name)?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">该角色首页</label>
                        <div class="col-xs-9">
                            <select name="nav_list" class="form-control select">
                                <?php foreach ($menus as $k=>$v){?>
                                    <option <?=is_selected($nav_list,$v['nav_list'])?> value="<?=$v['nav_list']?>"><?=$v['lefthtml']?><?=$v['name']?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">备注</label>
                        <div class="col-xs-9 col-xs-12">
                            <?=FormW::TextArea('remark',5,$remark)?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3  control-label">是否通过</label>
                        <div class="col-xs-9">
                            <label class="switch">
                                <input type="checkbox" name="status" <?=is_checked($status)?> value="1"/>
                                <span class="help-block"></span>
                            </label>
                            <span class="help-block">默认正常</span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-5">
                    <div class="form-group">
                        <div class="col-md-3">
                            <div class="btn-group">
                                <a id="zk" class="btn btn-info">展开</a>
                                <a id="gb" class="btn btn-default">全选</a>
                            </div>
                        </div>
                        <div class="col-xs-9">
                            <ul id="tree-checkmenu" class="checktree showtime" style="display:block">
                                <?php foreach ($menuList as $k=>$v){?>
                                    <li id="show-explorer<?=$k?>" class="plus">
                                        <i id="bjgl" class="plus"></i>
                                        <input <?=in_array($v['id'],$rules)?"checked":""?> id="check-explorer<?=$k?>" name="rules[]" value="<?=$v['id']?>" type="checkbox" /><?=$v['name']?>
                                        <ul id="tree-explorer<?=$k?>" class="showtime">
                                            <?php foreach ($v['child'] as $k1=>$v1){?>
                                                <li id="show-iemac<?=$k?><?=$k1?>">
                                                    <i id="bjgl" class="plus"></i>
                                                    <input <?=in_array($v1['id'],$rules)?"checked":""?> id="check-iemac<?=$k?><?=$k1?>" name="rules[]" value="<?=$v1['id']?>" type="checkbox" /><?=$v1['name']?>
                                                    <ul id="tree-iemac<?=$k?><?=$k1?>" class="showtime">
                                                        <?php foreach ($v1['child'] as $k2=>$v2){?>
                                                            <li>
                                                                <i id="bjgl" class="plus"></i>
                                                                <input  <?=in_array($v2['id'],$rules)?"checked":""?>   name="rules[]" value="<?=$v2['id']?>" type="checkbox" /><?=$v2['name']?>
                                                                <ul class="showtime">
                                                                    <?php foreach ($v2['child'] as $k3=>$v3){?>
                                                                        <i id="bjgl" class="plus"></i>
                                                                        <li><input  <?=in_array($v3['id'],$rules)?"checked":""?> name="rules[]" value="<?=$v3['id']?>" type="checkbox" /><?=$v3['name']?></li>
                                                                    <?php }?>
                                                                </ul>
                                                            </li>
                                                        <?php }?>
                                                    </ul>
                                                </li>
                                            <?php }?>
                                        </ul>
                                    </li>
                                <?php }?>
                            </ul>
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