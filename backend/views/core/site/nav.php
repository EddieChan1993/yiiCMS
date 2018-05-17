<?php
use \yii\helpers\Url;
$newsInfo = $this->params['newsInfo'];
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
        <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>
    </li>
    <!-- END SIGN OUT -->
    <!-- MESSAGES -->
    <li class="xn-icon-button pull-right">
        <a href="javascript:void(0)" title="【编辑】个人资料" data-url="<?=Url::to(['core/admin/edit-self-page'])?>" onclick="edit_row(this)"><span class="fa fa-user"></span></a>
        <div class="informer informer-danger"></div>
    </li>
    <li class="xn-icon-button pull-right">
    </li>
    <li class="xn-icon-button pull-right">
        <a href="javascript:void(0)" title="小喇叭"><span class="fa fa-bullhorn"></span></a>
        <?php if (!empty($newsInfo)){?>
            <div class="informer informer-danger"><?=count($newsInfo)?></div>
        <?php }?>
        <div class="panel panel-primary animated zoomInDown xn-drop-left xn-panel-dragging">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="fa fa-bullhorn"></span>警告</h3>
                <div class="pull-right">
                    <span class="label label-danger"><?=!empty(count($newsInfo))?count($newsInfo):0?></span>
                </div>
            </div>
            <div class="panel-body list-group scroll" style="height: 200px;">
                <?php foreach ($newsInfo as $obj){?>
                    <a class="list-group-item" href="#">
                        <strong><?=$obj?></strong>
                        <br/>
                        <small class="text-muted"><?=date('Y-m-d H:i:s')?></small>
                    </a>
                <?php }?>
            </div>
        </div>
    </li>
</ul>
