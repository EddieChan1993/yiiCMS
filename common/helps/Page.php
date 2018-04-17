<?php
/**
 * 分页类
 *
 * 调用方式：
 * $p=new Page(总页数,显示页数,当前页码,每页显示条数,[链接]);
 * print_r($p->getPages()); //生成一个页码数组（键为页码，值为链接）
 * echo $p->showPages(1); //生成一个页码样式（可添加自定义样式）
 *
 * @author: Dzer <Email:358654744@qq.com Blog:Dzer.me>
 * @version: 2014-12-25 09:09:42
 * @Last Modified time: 2014-12-28 17:37:13
 */
use think\Request;

/**
 * 由于部署iis7.0下时，tp5自带的分页出现未知错误，自己动手封装了一个page分页
 * 我的自定义分页样式，需要结合extend文件夹里的Page.class
 * 使用方式:
 * $orderNums总的数据量
 * $pagesList = new \Page($orderNums);
 * $pagesList->showPages()调用分页
 * $orderArr = Db::name('order')
 * ->order('order_id desc')
 * ->epage()//自己的page的优化
 * ->select();
 *
 *   function epage()
 * {
 * $page=input('?page')?input('page'):1;//加了这段
 * $listRows = config('my_page.list_nums');//加了这段
 * if (is_null($listRows) && strpos($page, ',')) {
 * list($page, $listRows) = explode(',', $page);
 * }
 * $this->options['page'] = [intval($page), intval($listRows)];
 * return $this;
 * }
 * 也可以
 * 这样
 * pagenate(config('my_page.list_nums')
 */
class Page
{
    protected $count;  //总条数
    protected $showPages; //需要显示的页数
    protected $countPages; //总页数
    protected $currPage; //当前页
    protected $subPages; //每页显示条数
    protected $href;  //连接
    protected $page_arr = array(); //保存生成的页码 键页码 值为连接

    /**
     * __construct 构造函数（获取分页所需参数）
     * @param int $count 总条数
     * @param string $href 连接（不设置则获取当前URL）
     * @internal param int $showPages 显示页数
     * @internal param int $currPage 当前页数
     * @internal param int $subPages 每页显示数量
     */
    public function __construct($count, $href = '')
    {
        $this->count = $count;
        $this->showPages = config('my_page.pages_nums');
        $this->currPage = input('?page') ? input('page') : 1;
        $this->subPages = config('my_page.list_nums');

        //如果链接没有设置则获取当前连接
        if (empty($href)) {
            $this->href = request()->baseUrl();
        } else {
            $this->href = $href;
        }
        $this->construct_Pages();
    }

    /**
     * getPages 返回页码数组
     * @return array 一维数组 键为页码 值为链接
     */
    public function getPages()
    {
        return $this->page_arr;
    }

    /**
     * showPages 返回生成好的页码
     * @param int $style 样式
     * @return string  生成好的页码
     */
    public function showPages($style = 1)
    {
        $func = 'pageStyle' . $style;
        return $this->$func();
    }

    /**
     * 样式1
     */
    protected function pageStyle1()
    {

        /* 构造普通模式的分页
        共4523条记录,每页显示10条,当前第1/453页 [首页] [上页] [1] [2] [3] .. [下页] [尾页]
        */
//        $pageStr = '共' . $this->count . '条记录，每页显示' . $this->subPages . '条';
//        $pageStr .= '当前第' . $this->currPage . '/' . $this->countPages . '页 ';

        $_GET['page'] = 1;
        $pageStr = '<ul class="pagination"><li><a href="' . $this->href . '?page=' . $_GET['page'] . '">首页</a></li>';
        //如果当前页不是第一页就显示上页
        if ($this->currPage > 1) {
            $_GET['page'] = $this->currPage - 1;
            $pageStr .= '<li><a href="' . $this->href . '?page=' . $_GET['page'] . '"><span>&laquo;</span></a></li>';
        }

        foreach ($this->page_arr as $k => $v) {
            if (input('?page')) {
                $active = input('page') == $k ? 'active' : '';
            } else {
                $active = $k == 1 ? 'active' : '';
            }
            $pageStr .= '<li class="' . $active . '"><a href="' . $v . '">' . $k . '</a></li>';
        }

        //如果当前页小于总页数就显示下一页
        if ($this->currPage < $this->countPages) {
            $_GET['page'] = $this->currPage + 1;
            $pageStr .= '<li><a href="' . $this->href . '?page=' . $_GET['page'] . '"><span>&raquo;</span></a> </li>';
        }

        $_GET['page'] = $this->countPages;
        $pageStr .= '<li><a href="' . $this->href . '?page=' . $_GET['page'] . '">尾页</a></li></ul>';

        return $pageStr;
    }

    /**
     * 样式2
     */
    protected function pageStyle2()
    {

        $pageStr = '';
        //如果当前页不是第一页就显示上页
        if ($this->currPage > 1) {
            $_GET['page'] = 1;
            $pageStr = '<a class="btn btn-success btn-xs btn-rounded" href="' . $this->href . '?page=' . $_GET['page'] . '"><i class="demo-psi-arrow-left"></i>首页</a>';

            $_GET['page'] = $this->currPage - 1;
            $pageStr .= '<a class="btn btn-primary btn-xs btn-rounded" href="' . $this->href . '?page=' . $_GET['page'] . '"><i class="demo-psi-arrow-left"></i>上一页</a>';
        }

        foreach ($this->page_arr as $k => $v) {
            if (count($this->page_arr)!=1) {
                if (input('?page')) {
                    $active = input('page') == $k ? 'btn-primary' : 'btn-default';
                } else {
                    $active = $k == 1 ? 'btn-primary' : 'btn-default';
                }
                $pageStr .= '<a style="margin:0px 4px" class="btn '.$active.' btn-rounded btn-xs" href="' . $v . '">' . $k . '</a>';
            }
        }
        //如果当前页小于总页数就显示下一页
        if ($this->currPage < $this->countPages) {
            $_GET['page'] = $this->currPage + 1;
            $pageStr .= '<a class="btn btn-primary btn-xs btn-rounded" href="' . $this->href . '?page=' . $_GET['page'] . '">下一页<i class="demo-psi-arrow-right"></i></a>';
            $_GET['page'] = $this->countPages;
            $pageStr .= '<a class="btn btn-success btn-xs btn-rounded" href="' . $this->href . '?page=' . $_GET['page'] . '"><i class="demo-psi-arrow-left"></i>尾页</a>';

        }
        return $pageStr;
    }

    protected function pageStyle3()
    {
        $getParam=$this->getUrlParam();
        $pageStr = '<ul class="pagination pagination-sm pull-right">';
        //如果当前页不是第一页就显示上页
        if ($this->currPage > 1) {
            $_GET['page'] = 1;
            $pageStr .= '<li><a href="' . $this->href . '?page=' . $_GET['page'].$getParam . '">首页</a></li>';
            $_GET['page'] = $this->currPage - 1;
            $pageStr .= '<li><a href="' . $this->href . '?page=' . $_GET['page'].$getParam . '"><span>«</span></a></li>';
        }

        foreach ($this->page_arr as $k => $v) {
            if (input('?page')) {
                $active = input('page') == $k ? 'active' : '';
            } else {
                $active = $k == 1 ? 'active' : '';
            }
            $pageStr .= '<li class="' . $active . '"><a href="' . $v .$getParam. '">' . $k . '</a></li>';
        }

        //如果当前页小于总页数就显示下一页
        if ($this->currPage < $this->countPages) {
            $_GET['page'] = $this->currPage + 1;
            $pageStr .= '<li><a href="' . $this->href . '?page=' . $_GET['page'] .$getParam. '"><span>»</span></a> </li>';

            $_GET['page'] = $this->countPages;
            $pageStr .= '<li><a href="' . $this->href . '?page=' . $_GET['page'] .$getParam. '">尾页</a></li></ul>';
        }
        return $pageStr;
    }

    /**
     * 获取处page之外的url参数
     * @return string
     */
    function getUrlParam()
    {
        $req= Request::instance();
        $url=$req->url();
        //获取?后面的参数
        $param = strstr($url, '?');
        if (strpos($param, "page")) {
            //如果带有page参数，则截取page
            $newParam = strstr($param, '&');
        }else{
            $str = mb_substr($param, 1);
            if (!empty($str)) {
                $newParam = "&".mb_substr($str,1);
            }else{
                $newParam = "";
            }
        }

        return $newParam;
    }


    /**
     * 生成页码数组
     * 键为页码，值为链接
     * $this->page_arr=Array(
     *     [1] => index.php?page=1
     *     [2] => index.php?page=2
     *     [3] => index.php?page=3
     *     ......)
     */
    protected function construct_Pages()
    {
        //计算总页数
        $this->countPages = ceil($this->count / $this->subPages);
        //根据当前页计算前后页数
        $leftPage_num = floor($this->showPages / 2);

        //左边显示数为当前页减左边该显示的数 例如总显示7页 当前页是5 左边最小为5-3 右边为5+3
        $left = $this->currPage - $leftPage_num;
        $left = max($left, 1); //左边最小不能小于1
        $right = $left + $this->showPages - 1; //左边加显示页数减1就是右边显示数
        $right = min($right, $this->countPages); //右边最大不能大于总页数
        $left = max($right - $this->showPages + 1, 1); //确定右边再计算左边，必须二次计算

        for ($i = $left; $i <= $right; $i++) {
            $this->page_arr[$i] = $this->href . '?page=' . $i;
        }
    }
}