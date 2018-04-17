$('#login_in_form').ajaxForm({
    beforeSubmit: showRequest,
    success: showResponse
});

function showRequest() {
    m_loading('用户验证中...',{
        time:-1
    })
}

function showResponse(res) {
    destory();
    if(res.error==0) {
        m_loading(res.msg,{
            time:500
        },function () {
            window.location.reload()
        })
    }else{
        var open_verify=$("#login_in_form").attr('open_verify');
        // if (open_verify=="prod") {
        //     LUOCAPTCHA.reset();
        // }
        m_error(res.msg,{
            time:1500
        });
    }
}
