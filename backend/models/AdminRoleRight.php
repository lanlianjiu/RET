<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin_role_right".
 *
 * @property integer $id
 * @property integer $role_id
 * @property integer $right_id
 * @property string $full_path
 * @property string $create_user
 * @property string $create_date
 * @property string $update_user
 * @property string $update_date
 */
class AdminRoleRight extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_role_right';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'right_id'], 'required'],
            [['role_id', 'right_id'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
            [['full_path'], 'string', 'max' => 250],
            [['create_user', 'update_user'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'role_id' => '角色主键',
            'right_id' => '权限主键',
            'full_path' => '全路径',
            'create_user' => '创建人',
            'create_date' => '创建时间',
            'update_user' => '修改人',
            'update_date' => '修改时间',
        ];
    }

}
