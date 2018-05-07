/**
 * Created by Administrator on 2017/6/30.
 */
/*==========================================================删除指定行==================================================*/
var del_tr;
var del_url;
function delete_row(dom){
    del_url = $(dom).attr('data-url');
    layer.confirm('是否删除该条数据？', {
        btn: ['确认','取消'],//按钮
        icon:2
    }, function(index){
        //调取服务器
        $.ajax({
            url: del_url,
            type:"JSON",
            beforeSend: function () {
                parent.m_loading('数据提交中，耐心等待...', {
                    time: -1
                })
            },
            success:function (res) {
                parent.destory();
                if(res.error==0) {
                    parent.m_success(res.msg,{time:500})
                    window.location.reload()
                }else{
                    parent.m_error(res.msg)
                }
                layer.close(index);
            }
        });
    }, function(){
        parent.m_warning('您已取消该操作');
    });
}
/*========================================================表单添加=====================================================*/
$('#add_form').ajaxForm({
    beforeSubmit: showRequest,
    success: showResponse
});

function showRequest() {
    parent.m_loading('数据提交中，耐心等待...',{
        time:-1
    })
}

function showResponse(res) {
    parent.destory();
    if(res.error==0) {
        parent.m_success(res.msg,{
            time:500,
        },function () {
            layer.confirm('是否继续添加？', {
                btn: ['确认', '取消'],//按钮
                icon: 1
            }, function (index) {
                layer.close(index);
            },function (index) {
                window.location.reload()
            });
        })
    }else{
        parent.m_error(res.msg);
    }
}

/*========================================================表单编辑=====================================================*/
//编辑页面弹出
function edit_row(dom) {
    layer.open({
        title:$(dom).attr('title'),
        type: 2,
        offset: '40px',
        closeBtn: 0,
        area:'869px',
        shadeClose: true,
        content: $(dom).attr('data-url'),
        success: function(layero, index) {
            layer.iframeAuto(index);
        }
    });
}

//编辑提交处理
$('#edit_form').ajaxForm({
    beforeSubmit: editRequest,
    success: editResponse
});

function editRequest() {
    m_loading('数据提交中，请耐心等待...',{
        time:-1
    });
}

function editResponse(res) {
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    destory();
    if(res.error==0) {
        m_success(res.msg,{
            time:500
        },function () {
            parent.layer.close(index);
            parent.window.location.reload()
        })
    }else{
        m_error(res.msg);
    }
}

/*========================================================菜单编辑=====================================================*/
//编辑提交处理
$('#edit_menu_form').ajaxForm({
    beforeSubmit: editRequest1,
    success: editResponse1
});

function editRequest1() {
    m_loading('数据提交中，请耐心等待...',{
        time:-1
    });
}

function editResponse1(res) {
    var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    destory();
    if(res.error==0) {
        m_success(res.msg,{
            time:500
        },function () {
            parent.layer.close(index);
        })
    }else{
        m_error(res.msg);
    }
}
