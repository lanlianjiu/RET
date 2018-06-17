<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin_menu".
 *
 * @property integer $id
 * @property string $code
 * @property string $menu_name
 * @property integer $module_id
 * @property string $display_label
 * @property string $des
 * @property integer $display_order
 * @property string $entry_right_name
 * @property string $entry_url
 * @property string $action
 * @property string $controller
 * @property string $has_lef
 * @property string $create_user
 * @property string $create_date
 * @property string $update_user
 * @property string $update_date
 *
 * @property AdminRight[] $adminRights
 */
class AdminMenu extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'menu_name', 'module_id', 'entry_url', 'action', 'controller'], 'required'],
            [['module_id', 'display_order'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
            [['code', 'entry_right_name', 'action', 'create_user', 'update_user'], 'string', 'max' => 50],
            [['menu_name', 'display_label', 'entry_url'], 'string', 'max' => 200],
            [['des'], 'string', 'max' => 400],
            [['controller'], 'string', 'max' => 100],
            [['has_lef'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'code' => 'code',
            'menu_name' => '名称',
            'module_id' => '模块id',
            'display_label' => '显示名',
            'des' => '描述',
            'display_order' => '显示顺序',
            'entry_right_name' => '入口地址名称',
            'entry_url' => '入口地址',
            'action' => '操作ID',
            'controller' => '控制器ID',
            'has_lef' => '是否有子',
            'create_user' => '创建人',
            'create_date' => '创建时间',
            'update_user' => '修改人',
            'update_date' => '修改时间',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdminRights()
    {
        return $this->hasMany(AdminRight::className(), ['menu_id' => 'id']);
    }

}
