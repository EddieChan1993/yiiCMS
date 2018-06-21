<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/17
 * Time: 16:53
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
        <div class="col-md-9">
            <div class="panel panel-default tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#tab-first" role="tab" data-toggle="tab"><?=$tab_1?>
                            <button class="btn btn-success btn-rounded btn-sm"><?=$dataNums?></button>
                        </a></li>
                    <li><a href="#tab-second" role="tab" data-toggle="tab"><?=$tab_2?></a></li>
                </ul>
                <div class="panel-body tab-content">
                    <div class="active tab-pane" id="tab-first">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>登陆名</th>
                                <th>头像</th>
                                <th>登录次数</th>
                                <th>角色</th>
                                <th>注册时间</th>
                                <th>最近登录IP</th>
                                <th>最近登录时间</th>
                                <th>状态</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($dataArr as $k=>$v){?>
                                <tr class="del_tr">
                                    <td><?=$v['user_login']?></td>
                                    <td  style="background: url('<?=is_img($v['avatar'])?>');background-size: contain;background-repeat: no-repeat;"></td>
                                    <td><span class="label label-danger"><?=$v['user_hits']?></span></td>
                                    <td><span class="label label-info"><?=get_role($v['id'])?></span></td>
                                    <td><?=tranTime($v['create_time'])?></td>
                                    <td><?=$v['last_login_ip']?></td>
                                    <td><?=tranTime($v['last_login_time'])?></td>
                                    <td><?=is_stop($v['user_status'])?></td>
                                    <td>
                                        <?php if ($v['id']==1){?>
                                            <?php if ($uid!=1){?>
                                                <a disabled title="<?=$v['user_login']?>【编辑】"  class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></a>
                                               <?php }else{?>
                                                <a title="<?=$v['user_login']?>【编辑】" data-url="<?= Url::to(['core/admin/edit-page','id'=>$v['id']])?>" onclick="edit_row(this)" class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></a>
                                            <?php }?>
                                            <button disabled class="btn btn-danger btn-rounded btn-sm" ><span class="fa fa-trash-o"></span></button>
                                            <?php }else{?>
                                            <a title="<?=$v['user_login']?>【编辑】" data-url="<?=Url::to(['core/admin/edit-page','id'=>$v['id']])?>" onclick="edit_row(this)"  class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></a>
                                            <button data-url="<?=Url::to(['core/admin/del','id'=>$v['id']])?>" onClick="delete_row(this);" class="btn btn-danger btn-rounded btn-sm" ><span class="fa fa-trash-o"></span></button>
                                        <?php }?>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                        <div class="panel-footer">
                            <?= $pages ?>
                        </div>                    </div>
                    <div class="tab-pane" id="tab-second">
                        <form id="add_form" action="<?=Url::to(['core/admin/add'])?>" method="post" class="form-horizontal">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">头像</label>
                                            <div class="col-md-9">
                                                <?=FormW::SingleUpload('avatar')?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">登录名</label>
                                            <div class="col-md-9">
                                                <?=FormW::Input('user_login')?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">密码</label>
                                            <div class="col-md-9">
                                                <?=FormW::Input('user_pass',null,'password')?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">确认密码</label>
                                            <div class="col-md-9">
                                                <input type="password" name="confirm_pass" class="form-control">
                                            </div>
                                        </div>
                                        <!--<div class="form-group">-->
                                        <!--<label class="col-md-3 control-label">邮箱</label>-->
                                        <!--<div class="col-md-9">-->
                                        <!--<input name="user_email" type="text" class="form-control"/>-->
                                        <!--</div>-->
                                        <!--</div>-->
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">角色</label>
                                            <div class="col-md-9">
                                                <select name="role_id" class="form-control select">
                                                <?php foreach ($roleArr as $k=>$v){?>
                                                    <option value="<?=$v['id']?>"><?=$v['name']?></option>
                                                <?php }?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3  control-label">管理员状态</label>
                                            <div class="col-md-9">
                                                <label class="switch">
                                                    <input name="status" type="checkbox" checked value="1"/>
                                                    <span></span>
                                                </label>
                                                <span class="help-block">默认正常</span>
                                            </div>
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

</script>