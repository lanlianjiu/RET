<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\models\WebMessageModel;

/**
 * Signup form
 */
class messageForm extends Model
{
    public $connet_name;
    public $connet_phone;
    public $email;
    public $address;
    public $verifyCode;
    public $message_content;
    public $feedback_img_url;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['connet_name', 'connet_phone', 'email', 'address', 'message_content'], 'required'],
            [['connet_name', 'email'], 'string', 'max' => 32],
            [['connet_phone'], 'string', 'max' => 11],
            [['address', 'message_content','feedback_img_url'], 'string', 'max' => 255],
            ['verifyCode','captcha']
        ];
    }

    public function attributeLabels(){
        return [
            'message_id' => '主键',
            'connet_name' => '联系人',
            'connet_phone' => '联系电话',
            'email' => '电子邮件',
            'address' => '地址',
            'message_content' => '内容',
            'verifyCode' => '',
            'feedback_img_url' => '图片',
            'create_date' => '创建时间',
            'is_look' => '是否查看',
        ];
    }

    /**
     * Signs user up.
     *
     * @return WebMessageModel|null the saved model or null if saving fails
     */
    public function savemessge()
    {
        if (!$this->validate()) {
            return false;
        }
        
        $saveinfo = new WebMessageModel();
        $saveinfo->is_look = 0;
        $saveinfo->create_date = date('Y-m-d h:i:s',time());
        $saveinfo->connet_name = $this->connet_name;
        $saveinfo->connet_phone = $this->connet_phone;
        $saveinfo->email = $this->email;
        $saveinfo->address = $this->address;
        $saveinfo->message_content = $this->message_content;
        $saveinfo->feedback_img_url = $this->feedback_img_url;
        
        return $saveinfo->save();
    }
}
