<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "web_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email_vaidate_token
 * @property string $email
 * @property integer $role
 * @property integer $status
 * @property string $avator
 * @property integer $vip_1v
 * @property integer $created_at
 * @property integer $updated_at
 */
class WebUserModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'web_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'role', 'status', 'created_at', 'updated_at'], 'required'],
            [['role', 'status', 'vip_1v', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'email', 'avator'], 'string', 'max' => 255],
            [['auth_key', 'password_reset_token', 'email_vaidate_token'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email_vaidate_token' => 'Email Vaidate Token',
            'email' => '邮箱',
            'role' => '角色',
            'status' => '状态',
            'avator' => 'Avator',
            'vip_1v' => '会员等级',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
}
