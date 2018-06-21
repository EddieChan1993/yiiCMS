<?php

use yii\helpers\Url;

$panel_title = $this->params['panel_title'];
$id = $get['condition']['id'];
$type =$get['condition']['type'];
?>
<br/>
<div class="animated fadeIn col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?= $panel_title ?></h3>
            <ul class="panel-controls">
                <label class="label label-info"><?= $dataNums ?></label>
            </ul>
        </div>
        <div class="panel-body">
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
                    <th>时间</th>
                    <th>类型</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($dataArr as $obj) { ?>
                    <tr class="del_tr">
                        <td><?= $obj['id'] ?></td>
                        <td><?= $obj['name'] ?></td>
                        <td><?= date("Y-m-d H:i:s", $obj['c_time']) ?></td>
                        <td><?= $obj['type'] ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
            <?= $pages ?>
    </div>
</div>
<script type="text/javascript">
</script>
