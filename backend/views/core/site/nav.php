<?php
use \yii\helpers\Url;
$newsInfo = $this->params['newsInfo'];
$urlArr = Yii::$app->params['link'];
?>
<ul class="x-navigation x-navigation-horizontal x-navigation-panel">
    <!-- TOGGLE NAVIGATION -->
    <li class="xn-icon-button">
        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
    </li>
    <!-- END TOGGLE NAVIGATION -->
    <!-- SEARCH -->
    <!--<li class="xn-search">
        <form role="form">
            <input type="text" name="search" placeholder="Search..."/>
        </form>
    </li>-->
    <!-- END SEARCH -->
    <!-- SIGN OUT -->
    <li class="xn-icon-button pull-right">
        <a href="javascript:void(0)" title="离开" class="mb-control" data-box="#mb-signout"><span class="fa fa-power-off"></span></a>
    </li>
    <!-- END SIGN OUT -->
    <!-- MESSAGES -->
    <li class="xn-icon-button pull-right">
        <a href="javascript:void(0)" title="【编辑】个人资料" data-url="<?=Url::to(['core/admin/edit-self-page'])?>" onclick="edit_row(this)"><span class="fa fa-user"></span></a>
        <div class="informer informer-danger"></div>
    </li>
    <?php if (!empty($urlArr)){?>
    <li class="xn-icon-button pull-right">
        <a title="快速导航" href="javascript:void(0)"><span class="fa fa-link"></span></a>
        <ul class="xn-drop-left xn-drop-white animated zoomInDown">
            <?php foreach ($urlArr as $k=>$v){?>
                <li><a target="_blank" href="<?=$v?>"><span class="fa fa-map-marker"></span><?=$k?></a></li>
            <?php }?>
        </ul>
    </li>
    <?php }?>
    <?php if (!empty($newsInfo)){?>
    <li class="xn-icon-button pull-right">
        <a href="javascript:void(0)" title="通告"><span class="fa fa-bullhorn"></span></a>
            <div class="informer informer-danger"><?=count($newsInfo)?></div>
        <div class="panel panel-primary animated zoomInDown xn-drop-left xn-panel-dragging">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="fa fa-bullhorn"></span>通告</h3>
                <div class="pull-right">
                    <span class="label label-danger"><?=count($newsInfo)?></span>
                </div>
            </div>
            <div class="panel-body list-group scroll" style="height: 200px;">
                <?php foreach ($newsInfo as $obj){?>
                    <a class="list-group-item" href="#">
                        <strong><?=$obj['message']?></strong>
                        <br/>
                        <small class="text-muted"><?=$obj['time']?></small>
                    </a>
                <?php }?>
            </div>
        </div>
    </li>
    <?php }?>
</ul>
