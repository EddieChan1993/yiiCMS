<?php
use yii\helpers\Url;
?>
<br/>
<div class="row">
    <div class="col-md-3">
        <div class="widget widget-primary">
            <div class="widget-title">TOTAL</div>
            <div class="widget-subtitle">26/08/2014</div>
            <div class="widget-int">$ <span data-toggle="counter" data-to="1564">1,564</span></div>
            <div class="widget-controls">
                <a href="#" class="widget-control-left"><span class="fa fa-upload"></span></a>
                <a href="#" class="widget-control-right"><span class="fa fa-times"></span></a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="widget widget-warning widget-item-icon">
            <div class="widget-item-right">
                <span class="fa fa-envelope"></span>
            </div>
            <div class="widget-data-left">
                <div class="widget-int num-count">48</div>
                <div class="widget-title">New messages</div>
                <div class="widget-subtitle">In your mailbox</div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?=Url::to('@web/alpha/js/demo_charts_morris.js')?>"></script>

