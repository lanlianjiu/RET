<?php
namespace backend\models;

use Yii;
use backend\models\AdminUserRole;
/**
 * This is the model class for table "admin_role".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $des
 * @property string $create_user
 * @property string $create_date
 * @property string $update_user
 * @property string $update_date
 *
 * @property AdminUserRole[] $adminUserRoles
 */
class AdminRole extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['create_date', 'update_date'], 'safe'],
            [['code', 'name', 'create_user', 'update_user'], 'string', 'max' => 50],
            [['des'], 'string', 'max' => 400]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'code' => '角色编号',
            'name' => '角色名称',
            'des' => '角色描述',
            'create_user' => '创建人',
            'create_date' => '创建时间',
            'update_user' => '更新人',
            'update_date' => '更新时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdminUserRoles()
    {
        return $this->hasMany(AdminUserRole::className(), ['role_id' => 'id']);
    }

}
