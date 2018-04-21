<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-03-01
 * Time: 10:58
 */

namespace common\helps;

use app\models\AlphaMenu;
use app\models\AlphaRole;
use app\models\AlphaRoleUser;
use app\models\AlphaUsers;
use Yii;
use yii\web\Controller;

class AuthE extends Controller
{
    protected $_config = [
        'auth_on' => true,           // 认证开关
        'auth_open_id' => [1]            //不需要验证的id
    ];

    public function __construct()
    {
        $authParams = \Yii::$app->params['auth'];
        if (!empty($authParams)) {
            //可设置配置项 auth_config, 此配置项为数组。
            $this->_config = array_merge($this->_config, $authParams);
        }
    }

    public function check($uid)
    {
        if (in_array($uid, $this->_config['auth_open_id']) && !empty($this->_config['auth_open_id'])) {
            //如果配置的有不需要验证的id，那么判断和该用户id是否匹配
        } else {
            if ($this->_config['auth_on']) {
                //获取当前的[模块][控制器][操作方法]
                $map = [
                    'controller' => Yii::$app->controller->id,
                    'method' => Yii::$app->controller->action->id
                ];
                $authOne = AlphaMenu::find()
                    ->where($map)
                    ->asArray()
                    ->select('id,type,name,status')
                    ->one();
                if ($authOne['type'] == 1) {
                    //该菜单是否需要验证
                    if ($authOne['status'] == 1) {
                        //只对没被禁用的菜单进行验证
                        $userStatus = AlphaUsers::find()
                            ->where(['id' => $uid])
                            ->select('user_status')
                            ->one();
                        if ($userStatus->user_status === 0) {
                            throw new \Exception("操作无效,该管理员已经【被禁用】");
                        }
                        $this->role_rule_in($uid, $authOne['id'], $authOne['name']);
                    } else {
                        throw new \Exception($authOne['name'] . '权限【被暂时禁用】');
                    }
                }
            }
        }
    }

    /**
     * 判断该角色是否拥有该权限
     * @param $uid
     * @param $rule_id
     * @param $rule_name
     * @throws \Exception
     */
    function role_rule_in($uid, $rule_id, $rule_name)
    {
        $groupAccess=AlphaRoleUser::find()
            ->where(['user_id' => $uid])
            ->asArray()
            ->one();
        $group = AlphaRole::find()
            ->where(['id' => $groupAccess['role_id']])
            ->asArray()
            ->one();
        if ($group['status']) {
            $rules = explode(',', $group['rules']);
            if (!in_array($rule_id, $rules)) {
                //该角色不包含该权限
                throw new \Exception('无权操作【' . $rule_name . '】权限');
            }
        } else {
            //该角色所有权限被禁
            throw new \Exception('该角色所有权限暂时【被禁用】');
        }

    }

    /**
     * 获取当前用户的权限菜单
     * @param $uid
     * @return array
     */
    function getAuthMenu($uid)
    {
        if (in_array($uid,$this->_config['auth_open_id'])){
            //超级用户id，不需要被验证，拥有所有权限
            $req = [
                'type' => AlphaMenu::ONLY_MENU,
                'status' => AlphaMenu::PASS,//没被禁用的
            ];
        } else {
            $groupAccess = AlphaRoleUser::findOne(['user_id', $uid]);
            $group = AlphaRole::findOne($groupAccess->role_id);

            $rules = explode(',', $group->rules);

            $req = [
                'and',
                ['in','id',$rules],
                ['type'=>AlphaMenu::ONLY_MENU,'staus'=>AlphaMenu::PASS]
            ];
        }

        $menuArr = AlphaMenu::find()
            ->where($req)
            ->asArray()
            ->orderBy('listorder desc')
            ->all();


        $menuAuth = get_tree_array($menuArr, 'parentid');//菜单树
        return $menuAuth;
    }
}