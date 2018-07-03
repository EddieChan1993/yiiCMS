
(function(window){
    // 注入图标
    var svgSprite='<svg><symbol id="icon-warning" viewBox="0 0 1034 1024"><path d="M980.733125 821.860625L600.7559375 163.7796875c-46.4765625-80.458125-122.4328125-80.458125-168.8971875 0L51.8796875 821.860625c-46.464375 80.540625-8.4515625 146.240625 84.4125 146.240625l760.0246875 0C989.1846875 968.1003125 1027.158125 902.3965625 980.733125 821.860625zM464.11625 350.5034375c13.6546875-14.7628125 31.014375-22.145625 52.1859375-22.145625 21.1828125 0 38.5265625 7.305 52.1953125 21.8503125 13.5796875 14.578125 20.3671875 32.8096875 20.3671875 54.733125 0 18.8625-28.3453125 157.565625-37.8 258.4725l-68.2734375 0c-8.2921875-100.9078125-39.04875-239.61-39.04875-258.4725C443.744375 383.350625 450.543125 365.1940625 464.11625 350.5034375zM567.54125 830.316875c-14.3625 13.9875-31.453125 20.9578125-51.234375 20.9578125-19.7765625 0-36.871875-6.9703125-51.2315625-20.9578125-14.3203125-13.9546875-21.4378125-30.8578125-21.4378125-50.709375 0-19.7484375 7.1175-36.834375 21.4378125-51.1546875 14.3596875-14.325 31.455-21.4875 51.2315625-21.4875 19.78125 0 36.871875 7.1625 51.234375 21.4875 14.3109375 14.3203125 21.4453125 31.40625 21.4453125 51.1546875C588.9865625 799.4590625 581.8521875 816.3621875 567.54125 830.316875z" fill="#e0620d" ></path></symbol><symbol id="icon-loading" viewBox="0 0 1024 1024"><path d="M542.28965557 296.04655215c-64.52068974 0-117.03103418-52.49482734-117.03103507-117.01551797C425.25862051 114.5258624 477.76896582 62 542.28965557 62c64.52068974 0 117 52.49482734 117 117.03103418 0 64.52068974-52.47931026 117.01551709-117 117.01551796z m-249.12931114 92.93275811c-58.93448291 0-106.89827607-47.94827607-106.89827519-106.91379317s47.96379317-106.91379316 106.89827519-106.91379316a107.02241367 107.02241367 0 0 1 106.88275899 106.91379316c0 58.93448291-47.94827607 106.91379316-106.88275899 106.91379317zM187.28620683 630.81551709A94.34482734 94.34482734 0 0 1 93.03448291 536.51724102a94.34482734 94.34482734 0 0 1 94.25172392-94.25172393 94.34482734 94.34482734 0 0 1 94.23620684 94.25172393 94.34482734 94.34482734 0 0 1-94.23620684 94.28275898z m105.8741376 239.58620684a80.02241367 80.02241367 0 0 1-79.92931026-79.94482735 80.03793076 80.03793076 0 0 1 79.91379317-79.92931025 80.03793076 80.03793076 0 0 1 79.92931026 79.92931025c0 44.06896582-35.84482734 79.94482734-79.91379317 79.94482735zM542.28965557 962a69.88965557 69.88965557 0 0 1-69.82758633-69.82758633c0-38.51379316 31.32931026-69.82758633 69.82758633-69.82758633a69.88965557 69.88965557 0 0 1 69.81206836 69.82758633c0 38.51379316-31.31379316 69.82758633-69.82758633 69.82758633z m252.9-118.0241376a56.42068974 56.42068974 0 0 1-56.35862139-56.35862138 56.42068974 56.42068974 0 0 1 56.35862139-56.35862052 56.42068974 56.42068974 0 0 1 56.3586205 56.35862052 56.42068974 56.42068974 0 0 1-56.3586205 56.35862138z m103.57758545-260.7672419a46.30344785 46.30344785 0 0 1-46.24137862-46.24137948 46.30344785 46.30344785 0 0 1 46.24137862-46.25689659 46.31896582 46.31896582 0 0 1 46.25689658 46.2413795 46.33448291 46.33448291 0 0 1-46.25689658 46.25689657z m-139.45344785-297.6827581a35.8758624 35.8758624 0 1 0 71.76724101 0.01551709 35.8758624 35.8758624 0 0 0-71.76724101 0z" fill="#1296db" ></path></symbol><symbol id="icon-error" viewBox="0 0 1024 1024"><path d="M480 64C217.6 64 0 281.6 0 544s217.6 480 480 480 480-217.6 480-480S742.4 64 480 64z m204.8 614.4c19.2 19.2 19.2 44.8 0 64-19.2 19.2-44.8 19.2-64 0L486.4 608 345.6 748.8c-19.2 19.2-51.2 19.2-70.4 0-19.2-19.2-19.2-51.2 0-70.4L416 537.6 281.6 403.2c-19.2-19.2-19.2-44.8 0-64 19.2-19.2 44.8-19.2 64 0L480 473.6l140.8-140.8c19.2-19.2 51.2-19.2 70.4 0 19.2 19.2 19.2 51.2 0 70.4L550.4 544l134.4 134.4z" fill="#df2007" ></path></symbol><symbol id="icon-info" viewBox="0 0 1024 1024"><path d="M512 0C229.23 0 0 229.23 0 511.999 0 794.759 229.23 1024 512 1024c282.76 0 512-229.241 512-512.001C1024 229.23 794.76 0 512 0z m0 832c-26.51 0-47.999-21.48-47.999-48.001 0-26.52 21.489-48 47.999-48 26.519 0 47.999 21.48 47.999 48C559.999 810.52 538.519 832 512 832z m47.999-239.999C559.999 618.52 538.519 640 512 640c-26.51 0-47.999-21.48-47.999-47.999v-352C464.001 213.49 485.49 192 512 192c26.519 0 47.999 21.49 47.999 48.001v352z" fill="#5677FC" ></path></symbol><symbol id="icon-success" viewBox="0 0 1024 1024"><path d="M512 992A480 480 0 1 1 512 32a480 480 0 0 1 0 960z m-46.49142844-353.62285688L328.22857156 499.45142844 237.71428531 585.92c65.82857156 35.45142844 158.05714313 100.11428531 237.05142938 200.36571469C530.58285688 681.37142844 702.62857156 466.74285688 786.28571469 447.54285688c-13.50857156-54.10285688-21.12-155.65714313 0-209.82857157-171.56571469 113.14285688-320.77714313 400.66285687-320.77714313 400.66285782z" fill="#28ad10" ></path></symbol></svg>';var script=function(){var scripts=document.getElementsByTagName("script");return scripts[scripts.length-1]}();var shouldInjectCss=script.getAttribute("data-injectcss");var ready=function(fn){if(document.addEventListener){if(~["complete","loaded","interactive"].indexOf(document.readyState)){setTimeout(fn,0)}else{var loadFn=function(){document.removeEventListener("DOMContentLoaded",loadFn,false);fn()};document.addEventListener("DOMContentLoaded",loadFn,false)}}else if(document.attachEvent){IEContentLoaded(window,fn)}function IEContentLoaded(w,fn){var d=w.document,done=false,init=function(){if(!done){done=true;fn()}};var polling=function(){try{d.documentElement.doScroll("left")}catch(e){setTimeout(polling,50);return}init()};polling();d.onreadystatechange=function(){if(d.readyState=="complete"){d.onreadystatechange=null;init()}}}};var before=function(el,target){target.parentNode.insertBefore(el,target)};var prepend=function(el,target){if(target.firstChild){before(el,target.firstChild)}else{target.appendChild(el)}};function appendSvg(){var div,svg;div=document.createElement("div");div.innerHTML=svgSprite;svgSprite=null;svg=div.getElementsByTagName("svg")[0];if(svg){svg.setAttribute("aria-hidden","true");svg.style.position="absolute";svg.style.width=0;svg.style.height=0;svg.style.overflow="hidden";prepend(svg,document.body)}}if(shouldInjectCss&&!window.__iconfont__svg__cssinject__){window.__iconfont__svg__cssinject__=true;try{document.write("<style>.svgfont {display: inline-block;width: 1em;height: 1em;fill: currentColor;vertical-align: -0.1em;font-size:16px;}</style>")}catch(e){console&&console.log(e)}}ready(appendSvg)

    // 提示工厂
    /*
    *   @config    基本配置
    *       text    String    提示的内容
    *       type    String    | info 普通提示 | warning 警示 | error 错误 | success 成功 | loading 等待 |
    *       time    Number    自动关闭时间
    *       auto    Bolean    | true 会自动关闭 | false 不会自动关闭 |
    *
    *   @callback  回调函数
    *
    * */
    window._topTip = function (config, callback) {
        // 绑定配置
        config = config ? config : {};
        var conf = {
            text: '这是一条提示信息',
            type: 'info',
            time: 2800,
            auto: true
        };
        Object.assign(conf, config);
        // 生成DOM
        var dom = document.createElement('div');
        var bgc = '#fdfdfd';
        var fc = '#33414e'
        switch (conf.type) {
            case 'success':
                bgc = '#e1f3d8';
                fc = '#58c22e';
                break;
            case 'error':
                bgc = '#fde2e2';
                fc = '#f56c6c';
                break;
            case 'info':
                bgc = '#fdfdfd';
                fc = '#33414e';
                break;
            case 'loading':
                bgc = '#edf2fc';
                fc = '#33414e';
                break;
            case 'warning':
                bgc = '#fdf6ec';
                fc = '#ff9800';
                break;
        }
        dom.style.cssText = 'position: fixed;top:-30px;font-size:14px;padding:5px 10px;box-shadow: 0 1px 6px rgba(0,0,0,.2);border-radius:6px;transition: ease-out 300ms;opacity:0.1';
        dom.style.backgroundColor = bgc;
        dom.style.color = fc;
        var span = document.createElement('span');
        span.innerText = conf.text;
        dom.innerHTML = '<svg aria-hidden="true" style="display:inline-block;font-size:18px;margin:0 4px;position:relative;right:4px;width:1em;height:1em;vertical-align:-0.15em;fill:currentColor;overflow: hidden;"><use xlink:href="#icon-'+conf.type+'"></use></svg>';
        /* 添加loading的动画 */
        if (conf.type === 'loading') {
            var deg = 0;
            dom.firstElementChild.style.transition = '1000ms';
            dom.firstElementChild.style.transform = 'rotate(' + deg + 'deg)';
            setTimeout(function () {
                deg += 360;
                dom.firstElementChild.style.transform = 'rotate(' + deg + 'deg)';
            }, 0);
            var inter = setInterval(function () {
                deg += 360;
                dom.firstElementChild.style.transform = 'rotate(' + deg + 'deg)';
            }, 1000)
        }
        dom.appendChild(span);
        document.body.appendChild(dom);
        // 计算DOM宽度并居中 节流节约性能
        dom.style.left = (document.body.clientWidth - dom.clientWidth) / 2 + 'px';
        var throttle;
        window.onresize = function () {
            clearTimeout(timeout)
            throttle = setTimeout(function () {
                dom.style.left = (document.body.clientWidth - dom.clientWidth) / 2 + 'px';
            }, 200)
        };
        // 出现动画
        dom.style.top = '30px';
        dom.style.opacity = 1;
        // 自动消失
        if (conf.auto) {
            var timeout = setTimeout(function () {
                close();
            }, conf.time);
            // 悬停不消失
            dom.onmouseover = function () {
                clearTimeout(timeout);
            };
            // 移开消失
            dom.onmouseleave = close;
        }
        // 点击消失
         dom.onclick = close;
        // 主动调用销毁
        window._topTip.close = close;
        // 消失动画
        var deleted = false; // 避免重复删除
        function close() {
            if (!deleted) {
                clearInterval(inter)
                deleted = true;
                window._topTip.destory(dom, callback);
            }
        }
        return dom;
    }

    /* 便捷封装 */
    window._topTip.destory = function (dom, callback) {
        dom.style.transition = 'ease-in 300ms';
        dom.style.top = '-30px';
        dom.style.opacity = 0;
        setTimeout(function () {
            document.body.removeChild(dom);
        }, 1000);
        if (callback) {
            return callback();
        }
    };
    window._topTip.success = function (text, config, callback) {
        return bind('success', text, config, callback)
    };
    window._topTip.error = function (text, config, callback) {
        return bind('error', text, config, callback)
    };
    window._topTip.info = function (text, config, callback) {
        return bind('info', text, config, callback)
    };
    window._topTip.loading = function (text, config, callback) {
        return bind('loading', text, config, callback)
    };
    window._topTip.warning = function (text, config, callback) {
        return bind('warning', text, config, callback)
    };
    function bind(type, text, config, callback) {
        /* 可以在不传 config 的情况下传入 callback */
        if (typeof config === 'function') {
            callback = config;
            config = null
        }
        config = config ? config : {};
        var conf = {
            text: text,
            type: type
        };
        Object.assign(conf, config);
        return window._topTip(conf, callback)
    }

})(window);

