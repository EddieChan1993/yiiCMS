$('#login_in_form').ajaxForm({
    beforeSubmit: showRequest,
    success: showResponse
});
var loadingDom
function showRequest() {
    loadingDom=_topTip.loading(
        '用户验证中...',
        {
        auto: false
    })
}

function showResponse(res) {
    _topTip.destory(loadingDom);
    if(res.error==0) {
        _topTip.loading(res.msg,{
            time:500
        },function () {
            window.location.reload()
        })
    }else{
        var open_verify=$("#login_in_form").attr('open_verify');
        var is_open_verify=$("#login_in_form").attr('is_open_verify');
        if (is_open_verify==true&&open_verify=="prod") {
            LUOCAPTCHA.reset();
        }
        _topTip.warning(res.msg,{
            time:1500
        });
    }
}
