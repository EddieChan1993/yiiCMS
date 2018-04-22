<?php
$panel_title = $this->params['panel_title'];
?>
<div class="row animated fadeIn">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?=$panel_title?></h3>
                    <ul class="panel-controls">
                        <label class="label label-info"><?=$dataNums?></label>
                    </ul>
                </div>
                <div class="panel-body tab-content">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>图片</th>
                            <th>大小</th>
                            <th>存储位置</th>
                            <th>上传时间</th>
                            <th>操作者</th>
                            <th>操作ip</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($dataArr as $k=>$v){?>
                        <tr class="del_tr">
                            <td style="background: url(<?=$v['img_path']?>);background-repeat: no-repeat;background-size: contain"></td>
                            <td><?=$v['img_size']?></td>
                            <td><span class="label label-success"><?=\app\models\AlphaImgs::$uploadName[$v['type']]?></span></td>
                            <td><?=tranTime($v['upload_date'])?></td>
                            <td><?=get_users($v['user_id'])?></td>
                            <td><?=$v['ip']?></td>
                        </tr>
                        <?php }?>
                        </tbody>
                    </table>
                    <?=$pages?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
</script>
