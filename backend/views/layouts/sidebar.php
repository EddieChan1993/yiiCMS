<?php

use yii\helpers\Url;

$menuAuth = $this->params['menuAuth'];
$menuNavList = $this->params['menuNavList'];
$avatar = $this->params['avatar'];
$user_login = $this->params['user_login'];
$role_name = $this->params['role_name'];
?>
<div class="page-sidebar mCustomScrollbar _mCS_1 mCS-autoHide mCS_no_scrollbar page-sidebar-fixed scroll">
    <!-- START X-NAVIGATION -->
    <ul class="x-navigation x-navigation-custom">
        <li class="xn-logo">
            <a href="javascript:void(0)"></a>
            <a href="#" class="x-navigation-control"></a>
        </li>
        <li class="xn-profile">
            <div class="profile">
                <img style="border-radius: 4px" width="200px" height="150px" src="<?=$avatar?>" alt="John Doe"/>
                <div class="profile-data">
                    <div class="profile-data-name"><?=$user_login?></div>
                    <div style="margin-bottom: 3px" class="profile-data-title"><span class="label label-info"><?=$role_name?></span></div>
                    <!--<div class="profile-data-title">{$self.user_email}</div>-->
                </div>
            </div>
        </li>
        <?php foreach ($menuAuth as $k=>$v){?>
            <?php if (empty($v['child'])){?>
                <li  class="<?=in_array($v['id'],$menuNavList)?'active':''?> active_li">
                    <a href="#"  data-url="<?= Url::to([$v['module'].'/'.$v['controller'].'/'.$v['method']])?>" onclick="turn_url(this)"><span class="<?=$v['icon']?>"></span> <span class="xn-text"><?=$v['name']?></span></a>
                </li>
                <?php }else{?>
                <li class="<?=in_array($v['id'],$menuNavList)?'active':''?> xn-openable">
                    <a href="#"><span class=""></span> <span class="xn-text"><?=$v['name']?></span></a>
                    <ul>
                        <?php foreach ($v['child'] as $k1=>$v1){?>
                            <?php if (empty($v1['child'])){?>
                            <li class="<?=in_array($v1['id'],$menuNavList)?'active':''?> active_li"><a href="#" data-url="<?= Url::to([$v1['module'].'/'.$v1['controller'].'/'.$v1['method']])?>" onclick="turn_url(this)"><span class="<?=$v1['icon']?>"></span><?=$v1['name']?></a></li>
                             <?php }else{?>
                            <li><a href="#"><span class="<?=$v1['icon']?>"></span><?=$v1['name']?></a>
                                <ul>
                                    <?php foreach ($v['child'] as $k2=>$v2){?>
                                    <li  class="<?=in_array($v1['id'],$menuNavList)?'active':''?> active_li"><a href="#" data-url="<?= Url::to([$v2['module'].'/'.$v2['controller'].'/'.$v2['method']])?>" onclick="turn_url(this)"><span class="<?=$v2['icon']?>"></span><?=$v2['name']?></a></li>
                                   <?php }?>
                                </ul>
                            </li>
                            <?php }?>
                        <?php }?>
                    </ul>
                </li>
                <?php }?>
        <?php } ?>
    </ul>
    <!-- END X-NAVIGATION -->
</div>
<script src="controller/silder.js"></script>
<script type="text/javascript">

</script>
