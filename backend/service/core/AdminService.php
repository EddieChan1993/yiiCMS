<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2018/4/20
 * Time: 14:31
 */

namespace backend\service\core;


use app\models\AlphaRole;
use app\models\AlphaRoleUser;
use app\models\AlphaUsers;
use yii\db\Exception;

class AdminService extends AuthService
{

    /**
     * @param array $postData
     * @return bool
     * @throws \yii\db\Exception
     */
    public static function add(array $postData): bool
    {
        $db = \Yii::$app->db;
        $trans = $db->beginTransaction();
        $flag = false;
        try {
            $userLogin = $postData['AlphaUsers']['user_login'];
            $userPass = $postData['AlphaUsers']['user_pass'];

            if (empty($userLogin)) {
                throw new \Exception("账号不能为空");
            }

            if ($postData['confirm_pass'] != $userPass) {
                throw new \Exception("两次密码填写不一致");
            }
            $model = new AlphaUsers();
            $model->load($postData);


            //如果填写了密码,默认为改密码
            $randNums = random();
            $model->user_pass = encrypt_password($userPass, $randNums);
            $model->user_pass_salt = $randNums;


            $model->user_nicename = $userLogin;
            $model->user_status = !empty($postData['status']) ? $postData['status'] : AlphaUsers::STOP;
            $model->create_time = time();
            if (!$model->save()) {
                throw new \Exception(current($model->getFirstErrors()));
            }

            $roleUserModel = new AlphaRoleUser();
            $roleUserModel->user_id = $model->id;
            $roleUserModel->role_id = $postData['role_id'];
            if (!$roleUserModel->save()) {
                throw new \Exception(current($roleUserModel->getFirstErrors()));
            }

            $flag = true;
            $trans->commit();
        } catch (\Exception $e) {
            $trans->rollBack();
            self::setErr($e);
        }
        return $flag;
    }

    public static function getOne(): array
    {
        $users = AlphaUsers::find()
            ->where(['id' => self::$uid])
            ->asArray()
            ->one();
        $roleName = get_role(self::$uid);
        $roleList = self::getRoleList();

        $map = $users;
        $map['role_list'] = $roleList;
        $map['role_name'] = $roleName;

        return $map;
    }

    /**
     * 获取角色列表
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getRoleList()
    {
        $roleList = AlphaRole::find()
            ->select('id,name')
            ->asArray()
            ->all();
        return $roleList;
    }

    /**
     * 编辑逻辑
     * @param array $postData
     * @return bool
     * @throws \yii\db\Exception
     */
    public static function edit(array $postData): bool
    {
        $flag = false;
        $db = \Yii::$app->db;
        $trans = $db->beginTransaction();
        try {
            $userPass = $postData['AlphaUsers']['user_pass'];
            $userLogin = $postData['AlphaUsers']['user_login'];

            if (empty($userLogin)) {
                throw new \Exception("账号不能为空");
            }

            if ($postData['confirm_pass'] != $userPass) {
                throw new \Exception("两次密码填写不一致");
            }
            $model = AlphaUsers::findOne($postData['id']);
            $model->load($postData);

            if (!empty($userPass)) {
                $randNums = random();
                $model->user_pass = encrypt_password($userPass, $randNums);
                $model->user_pass_salt = $randNums;
            }

            $model->user_nicename = $userLogin;
            $model->user_status = !empty($postData['status']) ? $postData['status'] : AlphaUsers::STOP;
            $model->update_time = time();
            if (!$model->save()) {
                throw new \Exception(current($model->getFirstErrors()));
            }

            //删除之前关联的所有角色表
            AlphaRoleUser::deleteAll(['user_id' => $postData['id']]);

            $roleUserModel = new AlphaRoleUser();
            $roleUserModel->user_id = $model->id;
            $roleUserModel->role_id = $postData['role_id'];
            if (!$roleUserModel->save()) {
                throw new \Exception(current($roleUserModel->getFirstErrors()));
            }

            $flag = true;
            $trans->commit();
        } catch (\Exception $e) {
            $trans->rollBack();
            self::setErr($e);
        }
        return $flag;
    }

    /**
     * 编辑个人资料
     * @param $postData
     * @return bool
     */
    public static function editSelf($postData):bool
    {
        $flag = false;
        try {
            $userPass = $postData['AlphaUsers']['user_pass'];
            $userLogin = $postData['AlphaUsers']['user_login'];
            if (empty($userLogin)) {
                throw new \Exception("账号不能为空");
            }

            if ($postData['confirm_pass'] != $userPass) {
                throw new \Exception("两次密码填写不一致");
            }
            $model = AlphaUsers::findOne($postData['id']);
            $model->load($postData);

            if (!empty($userPass)) {
                $randNums = random();
                $model->user_pass = encrypt_password($userPass, $randNums);
                $model->user_pass_salt = $randNums;
            }

            $model->user_nicename = $userLogin;
            $model->update_time = time();
            if (!$model->save()) {
                throw new \Exception(current($model->getFirstErrors()));
            }

            $flag = true;
        } catch (\Exception $e) {
            self::setErr($e);
        }
        return $flag;
    }

    /**
     * 删除
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public static function del(int $id): bool
    {

        $flag = false;
        $db = \Yii::$app->db;
        $trans = $db->beginTransaction();
        try {
            AlphaUsers::deleteAll(['id' => $id]);
            AlphaRoleUser::deleteAll(['user_id' => $id]);
            $flag = true;
            $trans->commit();
        } catch (\Exception $e) {
            $trans->rollBack();
            self::setErr($e);
        }
        return $flag;
    }


}