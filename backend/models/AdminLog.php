<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin_log".
 *
 * @property string $id
 * @property string $controller_id
 * @property string $action_id
 * @property string $url
 * @property string $module_name
 * @property string $func_name
 * @property string $right_name
 * @property string $client_ip
 * @property string $create_user
 * @property string $create_date
 */
class AdminLog extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_date'], 'safe'],
            [['controller_id', 'action_id'], 'string', 'max' => 20],
            [['url'], 'string', 'max' => 200],
            [['module_name', 'func_name', 'right_name', 'create_user'], 'string', 'max' => 50],
            [['client_ip'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'controller_id' => '控制器ID',
            'action_id' => '方法ID',
            'url' => '访问地址',
            'module_name' => '模块',
            'func_name' => '功能',
            'right_name' => '方法',
            'client_ip' => '客户端IP',
            'create_user' => '用户',
            'create_date' => '时间',
        ];
    }

}
