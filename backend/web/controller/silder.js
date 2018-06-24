/**
 * Created by EVE on 2017/6/29.
 */
//菜单跳转地址
function turn_url(dom) {
    $('#frame').attr('src', $(dom).attr('data-url'));
    $.mpb('show',{value: [0,83],speed: 1,state:'info'});
    var iframe = document.getElementById("frame");
    if (iframe.attachEvent) {
        iframe.attachEvent("onload", function() {
            //iframe加载完成后你需要进行的操作
            $.mpb('update',{value: [85,100],speed: 1});
        });
    } else {
        iframe.onload = function() {
            //iframe加载完成后你需要进行的操作
            $.mpb('update',{value: [83,100],speed: 1});
        };
    }
}

//导航菜单选中事件
$('.active_li').click(function () {
    $(this).addClass('active');
    $('.active_li').not(this).removeClass('active');
});

function edit_row(dom) {
    layer.open({
        title:$(dom).attr('title'),
        type: 2,
        offset: '100px',
        // closeBtn: 0,
        area:'869px',
        shadeClose: true,
        content: $(dom).attr('data-url'),
        success: function(layero, index) {
            layer.iframeAuto(index);
        }
    });
}