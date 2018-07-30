<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/20
 * Time: 15:14
 */

use common\helps\FormE;
use yii\helpers\Url;

?>
<div class="panel panel-default">
    <form id="edit_form" action="<?= Url::to(['update'])?>" method="post" class="form-horizontal">
        <div class="panel-body">
            <input type="hidden" name="id" value="<?=$id?>">
            <div class="row">
                <div class="col-xs-10">
                    <div class="form-group">
                        <label class="col-xs-3 control-label">头像</label>
                        <div class="col-xs-6">
                            <?=FormE::singleUpload('avatar',$avatar)?>
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
