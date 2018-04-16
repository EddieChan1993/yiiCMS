<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\cache\driver\Memcache;
use think\Db;
use think\Log;
use think\Response;

function dump($data)
{
    echo '<pre/>';
    var_dump($data);
    die;
}
/**
 * 数据签名，是否登录的判断用
 *用于存储签名session和cookie
 * @param array $data 被认证的数据
 * @return string 签名
 */
function data_signature($data = [])
{
    if (!is_array($data)) {
        $data = (array)$data;
    }
    ksort($data);
    $code = http_build_query($data);
    $sign = sha1($code);
    return $sign;
}

/**
 * 所有用到密码的不可逆加密方式
 * @author rainfer <81818832@qq.com>
 * @param string $password
 * @param string $password_salt
 * @return string
 */
function encrypt_password($password, $password_salt)
{
    return md5(md5($password) . md5($password_salt));
}

/**
 * 随机字符,用于生成password_salt用
 * @param int $length 长度
 * @param string $type 类型
 * @param int $convert 转换大小写 1大写 0小写
 * @return string
 */
function random($length = 10, $type = 'letter', $convert = 0)
{
    $config = array(
        'number' => '1234567890',
        'letter' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
        'string' => 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789',
        'all' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
    );

    if (!isset($config[$type])) $type = 'letter';
    $string = $config[$type];

    $code = '';
    $strlen = strlen($string) - 1;
    for ($i = 0; $i < $length; $i++) {
        $code .= $string{mt_rand(0, $strlen)};
    }
    if (!empty($convert)) {
        $code = ($convert > 0) ? strtoupper($code) : strtolower($code);
    }
    return $code;
}

/**
 * 获取惟一订单号
 * @return string
 */
function sp_get_order_sn()
{
    return date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
}

/**
 * 加密函数
 * @param string $txt 需加密的字符串
 * @param string $key 加密密钥，默认读取data_auth_key配置
 * @return string 加密后的字符串
 */
function set_secret($txt)
{
    $key = "GLZpriHMdRo5Slmau9zeFxkhIBNwPEOyW6104UT3";
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-=_";
    $nh = rand(0, 64);
    $ch = $chars[$nh];
    $mdKey = md5($key . $ch);
    $mdKey = substr($mdKey, $nh % 8, $nh % 8 + 7);
    $txt = base64_encode($txt);
    $tmp = '';
    $k = 0;
    for ($i = 0; $i < strlen($txt); $i++) {
        $k = $k == strlen($mdKey) ? 0 : $k;
        $j = ($nh + strpos($chars, $txt [$i]) + ord($mdKey[$k++])) % 64;
        $tmp .= $chars[$j];
    }
    return $ch . $tmp;
}

/**
 * 解密函数
 * @param string $txt 待解密的字符串
 * @param string $key 解密密钥，默认读取data_auth_key配置
 * @return string 解密后的字符串
 */
function open_secret($txt, $key = null)
{
    empty($key) && $key = config('data_auth_key');
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-=_";
    $ch = $txt[0];
    $nh = strpos($chars, $ch);
    $mdKey = md5($key . $ch);
    $mdKey = substr($mdKey, $nh % 8, $nh % 8 + 7);
    $txt = substr($txt, 1);
    $tmp = '';
    $k = 0;
    for ($i = 0; $i < strlen($txt); $i++) {
        $k = $k == strlen($mdKey) ? 0 : $k;
        $j = strpos($chars, $txt[$i]) - $nh - ord($mdKey[$k++]);
        while ($j < 0) {
            $j += 64;
        }
        $tmp .= $chars[$j];
    }
    return base64_decode($tmp);
}

/**
 * 返回按层级加前缀的菜单数组
 * @author  rainfer
 * @param array|mixed $menu 待处理菜单数组
 * @param string $id_field 主键id字段名
 * @param string $pid_field 父级字段名
 * @param string $lefthtml 前缀
 * @param int $pid 父级id
 * @param int $lvl 当前lv
 * @param int $leftpin 左侧距离
 * @return array
 */
function menu_left($menu, $id_field = 'id', $pid_field = 'pid', $lefthtml = '─ ', $pid = 0, $lvl = 0, $leftpin = 0)
{
    $arr = array();
    foreach ($menu as $v) {
        if ($v[$pid_field] == $pid) {
            $v['lvl'] = $lvl + 1;
            $v['leftpin'] = $leftpin;
            $v['lefthtml'] = '├' . str_repeat($lefthtml, $lvl);
            $arr[] = $v;
            $arr = array_merge($arr, menu_left($menu, $id_field, $pid_field, $lefthtml, $v[$id_field], $lvl + 1, $leftpin + 20));
        }
    }
    return $arr;
}


/**
 * 截取文字
 * @author rainfer <81818832@qq.com>
 *
 * @param string $text
 * @param int $length
 * @return string
 */
function subtext($text, $length)
{
    if (mb_strlen($text, 'utf8') > $length)
        return mb_substr($text, 0, $length, 'utf8') . '...';
    return $text;
}

/**
 *获取html文本里的img
 * @param string $content
 * @return array
 */
function sp_getcontent_imgs($content)
{
    import("phpQuery");
    \phpQuery::newDocumentHTML($content);
    $pq = pq();
    $imgs = $pq->find("img");
    $imgs_data = array();
    if ($imgs->length()) {
        foreach ($imgs as $img) {
            $img = pq($img);
            $im['src'] = $img->attr("src");
            $im['title'] = $img->attr("title");
            $im['alt'] = $img->attr("alt");
            $imgs_data[] = $im;
        }
    }
    \phpQuery::$documents = null;
    return $imgs_data;
}

/**
 * 去除字符串中的指定字符
 * @param string $str 待处理字符串
 * @param string $chars 需去掉的特殊字符
 * @return string
 */
function sp_strip_chars($str, $chars = '?<*.>\'\"')
{
    return preg_replace('/[' . $chars . ']/is', '', $str);
}

/**
 * 列出本地目录的文件
 * @author rainfer <81818832@qq.com>
 * @param string $path
 * @param string $pattern
 * @return array
 */
function list_file($path, $pattern = '*')
{
    if (strpos($pattern, '|') !== false) {
        $patterns = explode('|', $pattern);
    } else {
        $patterns [0] = $pattern;
    }
    $i = 0;
    $dir = array();
    if (is_dir($path)) {
        $path = rtrim($path, '/') . '/';
    }
    foreach ($patterns as $pattern) {
        $list = glob($path . $pattern);
        if ($list !== false) {
            foreach ($list as $file) {
                $dir [$i] ['filename'] = basename($file);
                $dir [$i] ['path'] = dirname($file);
                $dir [$i] ['pathname'] = realpath($file);
                $dir [$i] ['owner'] = fileowner($file);
                $dir [$i] ['perms'] = substr(base_convert(fileperms($file), 10, 8), -4);
                $dir [$i] ['atime'] = fileatime($file);
                $dir [$i] ['ctime'] = filectime($file);
                $dir [$i] ['mtime'] = filemtime($file);
                $dir [$i] ['size'] = filesize($file);
                $dir [$i] ['type'] = filetype($file);
                $dir [$i] ['ext'] = is_file($file) ? strtolower(substr(strrchr(basename($file), '.'), 1)) : '';
                $dir [$i] ['isDir'] = is_dir($file);
                $dir [$i] ['isFile'] = is_file($file);
                $dir [$i] ['isLink'] = is_link($file);
                $dir [$i] ['isReadable'] = is_readable($file);
                $dir [$i] ['isWritable'] = is_writable($file);
                $i++;
            }
        }
    }
    return $dir;
}

/**
 * 功能：获取时间差
 * @param $timeInt
 * @param string $format
 * @return string 时间差值
 * @internal param int $time
 */
function tranTime($timeInt, $format = 'Y-m-d H:i:s')
{
    if (empty($timeInt) || !is_numeric($timeInt) || !$timeInt) {
        return '';
    }
    $d = time() - $timeInt;
    if ($d < 0) {
        return '';
    } else {
        if ($d < 60) {
            return $d . '秒前';
        } else {
            if ($d < 3600) {
                return floor($d / 60) . '分钟前';
            } else {
                if ($d < 86400) {//小于24小时
                    return floor($d / 3600) . '小时前';
                } else {
                    if ($d < 604800) {//1周内
                        return floor($d / 86400) . '天前';
                    } else {
                        if ($d < 2592000) {//1个月内
                            return floor($d / 604800) . '周前';
                        } else {
                            if ($d < 31536000) {//1年
                                return floor($d / 2592000) . '月前';
                            } else {
                                return date($format, $timeInt);
                            }
                        }
                    }
                }
            }
        }
    }
}

/**
 * 获取树状结构数组
 * @param $data
 * @param $parent_name
 * @return array
 */
function get_tree_array($data, $parent_name)
{

    $tree = new \Tree();
    $tree->init($data, ['parentid' => $parent_name]);
    $menuList = $tree->get_arraylist($data);

    return $menuList;

}

/**
 * 获取选中id的下级树状图
 * @param $parent_id
 * @param string $parent_name
 * @param string $id_name
 * @return array
 * @internal param $data
 */
function get_child_tree($parent_id, $parent_name = 'parent_id', $id_name = 'client_id')
{
    $data = Db::name('client')->select();
    $tree = new \Tree();
    $config = [
        'id' => $id_name,
        'parentid' => $parent_name
    ];
    $tree->init($data, $config);
    $menuList = get_childs($parent_id);
    $menuList = $tree->get_arraylist($menuList, $parent_id);
    return $menuList;
}

/**
 * 获取孩子节点
 * @param $parent_id
 * @param string $parent_name
 * @param string $id_name
 * @return array
 */
function get_childs($parent_id, $parent_name = 'parent_id', $id_name = 'client_id')
{
    $data = Db::name('client')->select();
    $tree = new Tree();
    $config = [
        'id' => $id_name,
        'parentid' => $parent_name
    ];
    $tree->init($data, $config);
    $menuList = $tree->get_childs($data, $parent_id);

    return $menuList;
}

/**
 * 数组转为对象
 * @param $array
 * @return StdClass
 */
function array2object($array)
{
    if (is_array($array)) {
        $obj = new StdClass();
        foreach ($array as $key => $val) {
            $obj->$key = $val;
        }
    } else {
        $obj = $array;
    }
    return $obj;
}

/**
 * 对象转为数组
 * @param $object
 * @return mixed
 */
function object2array($object)
{
    if (is_object($object)) {
        foreach ($object as $key => $value) {
            $array[$key] = $value;
        }
    } else {
        $array = $object;
    }
    return $array;
}


/**
 *获取json字符串中的参数值
 * @param $json 参与转换的json
 * @param $key 需要获取的key的值
 * @return mixed key的值
 */
function getAttr($json, $key)
{
    $arr = json_decode($json);
    if (!empty($arr->$key)) {
        return $arr->$key;
    } else {
        return false;
    }
}

/**
 * @param $arrays
 * @param $sort_key
 * @param int $sort_order
 * @param int $sort_type
 * @return array
 * boolSORT_ASC - 默认，按升序排列。(A-Z)
 * SORT_DESC - 按降序排列。(Z-A)
 * 随后可以指定排序的类型：
 * SORT_REGULAR - 默认。将每一项按常规顺序排列。
 * SORT_NUMERIC - 将每一项按数字顺序排列。
 * SORT_STRING - 将每一项按字母顺序排列
 */

function my_sort($arrays, $sort_key, $sort_order = SORT_ASC, $sort_type = SORT_NUMERIC)
{
    if (is_array($arrays)) {
        foreach ($arrays as $array) {
            if (is_array($array)) {
                $key_arrays[] = $array[$sort_key];
            } else {
                return false;
            }
        }
    } else {
        return false;
    }
    array_multisort($key_arrays, $sort_order, $sort_type, $arrays);

    return $arrays;
}

/**
 * 去掉指定key
 * @param $data
 * @param $key
 * @return mixed
 */
function array_remove($data, $key)
{
    if (!array_key_exists($key, $data)) {
        return $data;
    }
    $keys = array_keys($data);
    $index = array_search($key, $keys);
    if ($index !== FALSE) {
        array_splice($data, $index, 1);
    }
    return $data;

}

/**
 *把用户输入的文本转义（主要针对特殊符号和emoji表情）
 * @param $str
 * @return mixed|string
 */
function userTextEncode($str)
{
    if (!is_string($str)) return $str;
    if (!$str || $str == 'undefined') return '';

    $text = json_encode($str); //暴露出unicode
    $text = preg_replace_callback("/(\\\u[ed][0-9a-f]{3})/i", function ($str) {
        return addslashes($str[0]);
    }, $text); //将emoji的unicode留下，其他不动，这里的正则比原答案增加了d，因为我发现我很多emoji实际上是\ud开头的，反而暂时没发现有\ue开头。
    return json_decode($text);
}

/**
 * 解码上面的转义
 * @param $str
 * @return mixed
 */
function userTextDecode($str)
{
    $text = json_encode($str); //暴露出unicode
    $text = preg_replace_callback('/\\\\\\\\/i', function ($str) {
        return '\\';
    }, $text); //将两条斜杠变成一条，其他不动
    return json_decode($text);
}


/**
 * 上传多图片
 * @param $name 文件名
 * @param $pathName 文件路径
 * @return string
 */
function upload_more($name, $pathName)
{
    $files = request()->file($name);
    foreach ($files as $k => $file) {
        if ($k <= 3) {
            $info = $file->move(ROOT_PATH . 'data' . DS . 'upload/' . $pathName);
            if ($info) {
                $imgJson[$k] = $info->getSaveName();
            } else {
                echo $file->getError();
            }
        }
    }

    return json_encode($imgJson);
}

/**
 * 单图上传
 * @param $name
 * @param $pathName
 * @return string
 */
function upload_sigle($name, $pathName)
{
    $file = request()->file($name);
    $info = $file->move('upload/' . $pathName);

    if ($info) {
        $drivePath = $info->getSaveName();
    } else {
        $drivePath = '';
    }
    return $drivePath;
}

/**
 * curl的post和get请求
 * @param $url （请求地址）
 * @param string $type (请求类型，post，get，默认为get)
 * @param string $res （返回json格式）
 * @param string $arr （传入参数）
 * @return mixed
 */
function http_curl($url, $type = 'get', $res = 'json', $arr = '')
{
    //1.初始化curl
    $ch = curl_init();
    //2.设置curl的参数
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    if ($type == 'post') {
        curl_setopt($ch, CURLOPT_POST, 1);//不自动输出要开启
        curl_setopt($ch, CURLOPT_POSTFIELDS, $arr);
    }
    //有些api接口需要证书，如果需要就开启
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // 从证书中检查SSL加密算法是否存在
    //3.采集
    $output = curl_exec($ch);
    //4.关闭
    curl_close($ch);
    if ($res == 'json') {
        return json_decode($output, true);
    } else {
        return $output;
    }
}

/**
 * 返回不含前缀的数据库表数组
 *
 * @author rainfer <81818832@qq.com>
 * @param bool
 * @return array
 */
function db_get_tables($prefix = false)
{
    $db_prefix = config('database.prefix');
    $list = Db::query('SHOW TABLE STATUS FROM ' . config('database.database'));
    $list = array_map('array_change_key_case', $list);
    $tables = array();
    foreach ($list as $k => $v) {
        if (empty($prefix)) {
            if (stripos($v['name'], strtolower(config('database.prefix'))) === 0) {
                $tables [] = strtolower(substr($v['name'], strlen($db_prefix)));
            }
        } else {
            $tables [] = strtolower($v['name']);
        }

    }
    return $tables;
}

/**
 * 返回数据表的sql
 *
 * @author rainfer <81818832@qq.com>
 *
 * @param $table : 不含前缀的表名
 * @return string
 */
function db_get_insert_sqls($table)
{
    $db_prefix = config('database.prefix');
    $db_prefix_re = preg_quote($db_prefix);
    $db_prefix_holder = db_get_db_prefix_holder();
    $export_sqls = array();
    $export_sqls [] = "DROP TABLE IF EXISTS $db_prefix_holder$table";
    switch (config('database.type')) {
        case 'mysql' :
            if (!($d = Db::query("SHOW CREATE TABLE $db_prefix$table"))) {
                $this->error("'SHOW CREATE TABLE $table' Error!");
            }
            $table_create_sql = $d [0] ['Create Table'];
            $table_create_sql = preg_replace('/' . $db_prefix_re . '/', $db_prefix_holder, $table_create_sql);
            $export_sqls [] = $table_create_sql;
            $data_rows = Db::query("SELECT * FROM $db_prefix$table");
            $data_values = array();
            foreach ($data_rows as &$v) {
                foreach ($v as &$vv) {
                    //TODO mysql_real_escape_string替换方法
                    //$vv = "'" . @mysql_real_escape_string($vv) . "'";
                    $vv = "'" . addslashes(str_replace(array("\r", "\n"), array('\r', '\n'), $vv)) . "'";
                }
                $data_values [] = '(' . join(',', $v) . ')';
            }
            if (count($data_values) > 0) {
                $export_sqls [] = "INSERT INTO `$db_prefix_holder$table` VALUES \n" . join(",\n", $data_values);
            }
            break;
    }
    return join(";\n", $export_sqls) . ";";
}

/**
 * 检测当前数据库中是否含指定表
 *
 * @author rainfer <81818832@qq.com>
 *
 * @param $table : 不含前缀的数据表名
 * @return bool
 */
function db_is_valid_table_name($table)
{
    return in_array($table, db_get_tables());
}

/**
 * 不检测表前缀,恢复数据库
 *
 * @author rainfer <81818832@qq.com>
 *
 * @param $file
 * @param $prefix
 */
function db_restore_file($file, $prefix = '')
{
    $prefix = $prefix ?: db_get_db_prefix_holder();
    $db_prefix = config('database.prefix');
    $sqls = file_get_contents($file);
    $sqls = str_replace($prefix, $db_prefix, $sqls);
    $sqlarr = explode(";\n", $sqls);
    foreach ($sqlarr as &$sql) {
        Db::execute($sql);
    }
}

/**
 * 返回表前缀替代符
 * @author rainfer <81818832@qq.com>
 *
 * @return string
 */
function db_get_db_prefix_holder()
{
//    return '<--db-prefix-->';
    return config('database.prefix');
}

/**
 * 强制下载
 * @author rainfer <81818832@qq.com>
 *
 * @param string $filename
 * @param string $content
 */
function force_download_content($filename, $content)
{
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Transfer-Encoding: binary");
    header("Content-Disposition: attachment; filename=$filename");
    echo $content;
    exit ();
}

//写日志
function write_log($content = '', $log_file_name)
{
    if (empty($log_file_name)) {
        throw new Exception("创建日志文件名为空");
    }
    if (!empty($content)) {
        $folder = config('log.path');
        $TxtFileName = $folder . $log_file_name . ".log";//创建文章

        if (!is_dir($folder)) {
            mkdir($folder,0755);
        }
        $content = sprintf("IP:%s\nTime:%s\nContent:\n%s\n", request()->ip(), date("Y-m-d H:i:s", time()), $content);
        $content .= "---------------------------------------------------------------\n";
        $TxtRes = fopen($TxtFileName, "a");
        fwrite($TxtRes, $content);
    }
}

/**
 * 转换文件大小
 * @param $size filesize($filePath)
 * @return string
 */
function getFileSize($size)
{
    if ($size >= pow(2, 40)) {
        $size = round($size / pow(2, 40), 3);
        $dw = "TB";
    } else if ($size >= pow(2, 30)) {
        $size = round($size / pow(2, 30), 3);
        $dw = "GB";
    } else if ($size >= pow(2, 20)) {
        $size = round($size / pow(2, 20), 3);
        $dw = "MB";
    } else if ($size >= pow(2, 10)) {
        $size = round($size / pow(2, 10), 3);
        $dw = "KB";
    } else {
        $dw = "Bytes";
    }
    return $size . $dw;

}

/**
 * 短信接口
 * @param $tel
 * @param $msg
 * @return array|string
 */
function send_sms($tel, $msg)
{
    $map = [
        'api_key' => plugins_value('msn', 'api_key'),
        'use_ssl' => FALSE
    ];
    $sign = plugins_value('msn', 'sign');
    $sms = new Sms($map);
    //send 单发接口，签名需在后台报备
    $res = $sms->send($tel, $msg . '【' . $sign . '】');
    if ($res) {
        if (isset($res['error']) && $res['error'] == 0) {
            return 'success';
        } else {
            return 'failed,code:' . $res['error'] . ',msg:' . $res['msg'];
        }
    } else {
        return $sms->last_error();
    }
}


/**
 * 获取指定插件某个参数值
 * @param $wid_key
 * @param $wid_name
 * @return string
 * @throws Exception
 */
function plugins_value($wid_key, $wid_name)
{
    $widgets = Db::name('widgets')
        ->where('wid_key', $wid_key)
        ->value('wid_params');

    if (empty($widgets)) {
        throw new Exception($wid_key . "插件不存在");
    }
    $params_arr = explode('|', $widgets);
    foreach ($params_arr as $k => $v) {
        $chids_arr = explode('=', $v);
        foreach ($chids_arr as $k) {
            if ($k == $wid_name) {
                return trim($chids_arr[1]);
            }
        }
    }

    throw new Exception($wid_name . "未注册");
}

/**
 * 获取邀请码
 * @param $user_id
 * @return string
 */
function createCode($user_id)
{
    static $source_string = 'E5FCDG3HQA4B1NOPIJ2RSTUV67MWX89KLYZ';
    $num = $user_id;
    $code = '';
    while ($num > 0) {
        $mod = $num % 35;
        $num = ($num - $mod) / 35;
        $code = $source_string[$mod] . $code;
    }
    if (empty($code[3]))
        $code = str_pad($code, 4, '0', STR_PAD_LEFT);
    return $code;
}

/**
 * 解除邀请码
 * @param $code
 * @return bool|int
 */
function decode($code)
{
    static $source_string = 'E5FCDG3HQA4B1NOPIJ2RSTUV67MWX89KLYZ';
    if (strrpos($code, '0') !== false)
        $code = substr($code, strrpos($code, '0') + 1);
    $len = strlen($code);
    $code = strrev($code);
    $num = 0;
    for ($i = 0; $i < $len; $i++) {
        $num += strpos($source_string, $code[$i]) * pow(35, $i);
    }
    return $num;
}

/**
 * 判断 cmf 核心是否安装
 * @return bool
 */
function is_installed()
{
    static $cmfIsInstalled;
    if (empty($cmfIsInstalled)) {
        $cmfIsInstalled = file_exists(ROOT . 'data/install.lock');
    }
    return $cmfIsInstalled;
}
/**
 * 添加图片日志
 * @param $path
 * @param $type
 * @param string $fileSize
 * @throws Exception
 */
function add_img_db($path,$type,$fileSize="")
{
    if ($type == 0) {
        $filePath = ".".$path;
        $fileSize = filesize($filePath);
    }
    $map = [
        'upload_date'=>time(),
        'img_size' => getFileSize($fileSize),
        'ip'=>request()->ip(),
        'user_id' => open_secret(cookie('UID')),
        'img_path'=>$path,
        'type'=>$type,
    ];
    $res=Db::name('imgs')->insert($map);
    if (!$res) {
        throw new Exception("图片插入日志错误");
    }
}
/*==========================================================extra=====================================================*/
