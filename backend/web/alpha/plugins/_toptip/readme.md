### 顶部弹出提示条
#### 用法
1. 引入top-tip.js 文件
2. 直接调用 _topTip(config, callback) 方法即可 
#### 参数说明
    /*
        *   @config    基本配置
        *       text    String    提示的内容
        *       type    String    | info 普通提示 | warning 警示 | error 错误 | success 成功 | loading 等待 |
        *       time    Number    自动关闭时间
        *       auto    Bolean    | true 会自动关闭 | false 不会自动关闭，需要鼠标点击标签才会关闭 |
        *
        *   @callback  回调函数 提示关闭时调用
        *   
        *   return   创建的标签DOM （手动销毁时候需要）
        * */
#### 其他
1. 鼠标悬停则不会消失
2. 鼠标移开触发关闭

#### 快捷调用
1. _topTip.success(text, config, callback) 成功提示
2. _topTip.error(text, config, callback)   错误提示
3. _topTip.info(text, config, callback)    普通提示
4. _topTip.loading(text, config, callback) 等待提示
5. _topTip.warning(text, config, callback) 警告提示

注意： 快捷调用时候，不用传config，直接传callback也可以

示例： _topTip.success('我没有传config，直接传的callback噢', function(){console.log('成功调用噢')})

#### 手动销毁
方法：
        _topTip.destory(dom, callback)
        
示例： 
1. var dom = _topTip.success('我返回了一个DOM元素噢')
2. _topTip.destory(dom, function(){ console.log('这个DOM元素已经被销毁了') })