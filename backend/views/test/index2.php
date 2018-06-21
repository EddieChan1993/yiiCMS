<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/18
 * Time: 15:35
 */

use common\helps\FormW;
use common\models\GamesInfo;
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
                            <strong>温馨提醒！</strong>产品【下架】后 ，将不会在渠道客户端显示
                        </div>
                        <form class="form-inline" action="<?= Url::to('index')?>" method="get">
                            <!--                <input type="hidden" value="test/index" name="r">-->
                            <div class="form-group">
                                <input class="form-control" value="<?= $id ?>" placeholder="Id" type="text" name="id">
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                    <input class="form-control datepicker"
                                           value="<?=$get['s_date']?>" placeholder="开始时间"
                                           type="text" name="s_date">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                        <input class="form-control datepicker"
                                               value="<?=$get['e_date'] ?>" placeholder="截至时间"
                                               type="text" name="e_date">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <select name="type" class="form-control select">
                                    <option <?= $type === '' ? "selected" : "" ?> value="">全部</option>
                                    <option <?= $type === "0" ? "selected" : "" ?> value="0">0</option>
                                    <option <?= $type === "1" ? "selected" : "" ?> value="1">1</option>
                                </select>
                            </div>
                            <button class="btn btn-success" type="submit">搜索</button>
                        </form>
                        <br/>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>类型</th>
                                <th>时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($dataArr as $obj) { ?>
                                <tr class="del_tr">
                                    <td><?= $obj['id'] ?></td>
                                    <td><?= $obj['name'] ?></td>
                                    <td><?= date("Y-m-d H:i:s", $obj['c_time']) ?></td>
                                    <td><?= $obj['type'] ?></td>
                                    <td>
                                        <a title="<?=$obj['name']?>【编辑】" data-url="<?= Url::to(['edit-page','id'=>$obj['id']])?>" onclick="edit_row(this)" class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></a>
                                        <button title="<?=$obj['name']?>【删除】" data-url="<?=Url::to(['delete','id'=>$obj['id']])?>" onClick="delete_row(this);" class="btn btn-danger btn-rounded btn-sm" ><span class="fa fa-trash-o"></span></button>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                            <?= $pages ?>
                    </div>
                    <div class="tab-pane" id="tab-second">
                        <form id="add_form" action="<?=Url::to(['add'])?>" method="post" class="form-horizontal">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">名称</label>
                                            <div class="col-md-9">
                                                <?=FormW::Input('game_name')?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">状态</label>
                                            <div class="col-md-9">
                                                <?=FormW::Select('status',["正常","无效"])?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button class="btn btn-info pull-right">保存<span class="fa fa-floppy-o fa-right"></span></button>
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
