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
<div class="row">
    <div class="panel panel-default">
        <form id="edit_form" method="post" action="" class="form-horizontal" role="form">
            <input type="hidden" value="" name="id">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-10">
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Text Field</label>
                            <div class="col-xs-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                    <input type="text" class="form-control"/>
                                </div>
                                <span class="help-block">This is sample of text field</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Password</label>
                            <div class="col-xs-9 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                    <input type="password" class="form-control"/>
                                </div>
                                <span class="help-block">Password field sample</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Textarea</label>
                            <div class="col-xs-9 col-xs-12">
                                <textarea class="form-control" rows="5"></textarea>
                                <span class="help-block">Default textarea field</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Img</label>
                            <div class="col-xs-9">
                                <div class="gallery">
                                    <a class="gallery-item"  href="javascript:void('')" title="Space picture 2" data-gallery>
                                        <div style="width: 200px;height: 80px" class="image" >
                                            <input hidden type="text" id="inp">
                                            <img src="__UPLOAD__/admin/common/upload.svg" alt="Space picture 2"/>
                                            <ul class="gallery-item-controls">
                                                <li onclick="upload_single('inp','setting')"><i class="fa fa-cloud-upload"></i></li>
                                                <li onclick="del_pic('inp')"><i class="fa fa-times"></i></li>
                                            </ul>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">File</label>
                            <div class="col-xs-9">
                                <div class="gallery">
                                    <a class="gallery-item"  href="javascript:void('')" title="Space picture 2" data-gallery>
                                        <div style="width: 150px" class="image" >
                                            <input hidden type="text" id="inp2">
                                            <img src="__UPLOAD__/admin/common/upload.svg" alt="Space picture 2"/>
                                            <ul class="gallery-item-controls">
                                                <li onclick="upload_single('inp2','setting','file')"><i class="fa fa-cloud-upload"></i></li>
                                                <li onclick="del_pic('inp2')"><i class="fa fa-times"></i></li>
                                            </ul>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Datepicker</label>
                            <div class="col-xs-9">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                    <input type="text" class="form-control datepicker" value="2014-11-01">
                                </div>
                                <span class="help-block">Click on input field to get datepicker</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Tags</label>
                            <div class="col-xs-9">
                                <input type="text" class="tagsinput" value="First,Second,Third"/>
                                <span class="help-block">Default textarea field</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label" data-style="btn-success">有颜色的select</label>
                            <div class="col-xs-9">
                                <select class="form-control select ">
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="5">Option 5</option>
                                </select>
                                <span class="help-block">Select box example</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">带搜索的select</label>
                            <div class="col-xs-9">
                                <select class="form-control select"  data-live-search="true">
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="5">Option 5</option>
                                </select>
                                <span class="help-block">Select box example</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Checkbox</label>
                            <div class="col-xs-9">
                                <label class="check"><input type="checkbox" class="icheckbox" checked="checked"/> Checkbox title</label>
                                <span class="help-block">Checkbox sample, easy to use</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3  control-label">菜单状态</label>
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
                <button class="btn btn-info pull-right">保存修改<span class="fa fa-floppy-o fa-right"></span></button>
            </div>
        </form>
    </div>

</div>
<script type="text/javascript" src="<?=Url::to('@web/alpha/js/demo_charts_morris.js')?>"></script>

