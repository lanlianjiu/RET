<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\models\userModel;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $rePassword;
    public $verifyCode;
    public $head_img;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\frontend\models\userModel', 'message' => Yii::t('frontend','This username has already been taken.')],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\frontend\models\userModel', 'message' => Yii::t('frontend','This email address has already been taken.')],

            [['password','rePassword'], 'required'],
            [['password','rePassword'], 'string', 'min' => 6],
            ['rePassword','compare','compareAttribute' => 'password','message' => Yii::t('frontend','Two times the password is not consitent.')],
            ['head_img', 'string', 'max' => 255],
            ['verifyCode','captcha']
        ];
    }

    public function attributeLabels(){
        return [
            'username' => '',
            'email' => '',
            'password' => '',
            'rePassword' => '',
            'verifyCode' => '',
            'head_img' => '',
        ];
    }

    /**
     * Signs user up.
     *
     * @return userModel|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new userModel();
        $user->username = $this->username;
        $user->email = $this->email;
         $user->head_img = $this->head_img;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
