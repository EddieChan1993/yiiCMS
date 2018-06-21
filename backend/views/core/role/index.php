<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/18
 * Time: 15:35
 */

use common\helps\FormW;
use yii\helpers\Url;
use yii\widgets\LinkPager;
$title = $this->params['title'];
$tab_1 = $this->params['tab_1'];
$tab_2 = $this->params['tab_2'];
?>
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"><?=$title?></span></h2>
</div>
<div class="row animated fadeIn">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#tab-first" role="tab" data-toggle="tab"><?=$tab_1?>
                            <button class="btn btn-success btn-rounded btn-sm"><?=$dataNums?></button>
                        </a></li>
                    <li><a href="#tab-second" role="tab" data-toggle="tab"><?=$tab_2?></a></li>
                </ul>
                <div class="panel-body tab-content">
                    <div class="tab-pane active" id="tab-first">
                        <div class="alert alert-info" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <strong>温馨提醒！</strong>点击编辑按钮,进行权限分配
                        </div>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>角色名称</th>
                                <th>角色描述</th>
                                <th>创建时间</th>
                                <th>更新时间</th>
                                <th>状态</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($dataArr as $k=>$v){?>
                                <tr class="del_tr">
                                    <td><?=$v['name']?></td>
                                    <td><?=$v['remark']?></td>
                                    <td><?=tranTime($v['create_time'])?></td>
                                    <td><?=tranTime($v['update_time'])?></td>
                                    <td><?=is_stop($v['status'])?></td>
                                    <td>
                                        <a title="<?=$v['name']?>【编辑】" data-url="<?= Url::to(['core/role/edit-page','id'=>$v['id']])?>" onclick="edit_row(this)" class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></a>
                                        <button data-url="<?=Url::to(['core/role/del','id'=>$v['id']])?>" onClick="delete_row(this);" class="btn btn-danger btn-rounded btn-sm" ><span class="fa fa-trash-o"></span></button>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                            <?= $pages ?>
                    </div>
                    <div class="tab-pane" id="tab-second">
                        <form id="add_form" action="<?=Url::to(['core/role/add'])?>" method="post" class="form-horizontal">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">角色名称</label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <?=FormW::Input('name')?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">备注</label>
                                            <div class="col-md-9 col-xs-12">
                                                <?=FormW::TextArea('remark')?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3  control-label">是否通过</label>
                                            <div class="col-md-9">
                                                <label class="switch">
                                                    <input type="checkbox" name="status" checked value="1"/>
                                                    <span class="help-block"></span>
                                                </label>
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
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
</script>
