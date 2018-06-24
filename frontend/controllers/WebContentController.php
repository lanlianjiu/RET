<?php

namespace frontend\controllers;
use Yii;
use frontend\models\messageForm;
use frontend\models\WebContentModel;
use yii\caching\Cache;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use frontend\models\SignupForm;
use frontend\models\LoginForm;
use yii\helpers\Url;
ini_set("display_errors", "on");
use Aliyun\Core\Config;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\SendBatchSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\QuerySendDetailsRequest;

// 加载区域结点配置
//Config::load();
class WebContentController extends \yii\web\Controller
{
    
     public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup','index', 'create','upload','ueditor'],
                'rules' => [
                    [
                        'actions' => ['signup','index'],
                        'allow' => true
                    ],
                    [
                        'actions' => ['logout','create','upload','ueditor'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '*' => ['get','post'],
                ],
            ],
        ];
    }


    public function actions(){
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'upload'=>[
                    'class'=>'common\widgets\file_upload\UploadAction',
                    'config'=>[
                        'imagePathFormat' => Url::base()."/uploadimg/{yyyy}{mm}{dd}/{time}{rand:6}",
                            ]
                    ],
            // 'ueditor'=>[
            //         'class'=>'common\widgets\file_upload\UeditorAction',
            //         'config'=>[
            //             'imagePathFormat' => "/uploadimg/{yyyy}{mm}{dd}/{time}{rand:6}",
            //                 ]
            //         ]
        ];
    }

    //公司首页
    public function actionIndex()
    {

         $womenDtat = Yii::$app->db->createCommand('
         SELECT 
         g.*
           FROM shp_goods g
          WHERE g.category_id=1001')->queryAll();

        return $this->render('index',["womendata"=>$womenDtat]);
    }

    //公司简介
    public function actionProfile()
    {
        return $this->render('profile');
    }

    //公司资质
    public function actionQualification()
    {
        return $this->render('qualification');
    }

    //工程案列
    public function actionProject()
    {
        return $this->render('project');
    }

    //联系我们
    public function actionContact()
    {
        return $this->render('contact');
    }

    //客户留言
    public function actionFeedback()
    {
        $model = new messageForm();
        return $this->render('feedback', [
            'model' => $model,
        ]);
    }

    public function actionCreatefeedback()
    {
        $model = new messageForm();
        // $model->load(Yii::$app->request->post());
        // return json_encode($model->savemessge());
        if ($model->load(Yii::$app->request->post())&&($model->savemessge())) {
           
           return $this->render('feedback', ['model' => $model]);
        } else {
           
          //return $this->render('feedback', ['model' => $model]);
        }
    }

     /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }
        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }
    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');
            return $this->goHome();
        }
        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    // --------------------------------------发送短信验证

    static $acsClient = null;

    /**
     * 取得AcsClient
     *
     * @return DefaultAcsClient
     */
    public static function getAcsClient() {
        //产品名称:云通信流量服务API产品,开发者无需替换
        $product = "Dysmsapi";

        //产品域名,开发者无需替换
        $domain = "dysmsapi.aliyuncs.com";

        // TODO 此处需要替换成开发者自己的AK (https://ak-console.aliyun.com/)
        $accessKeyId = "LTAIM1THoxl9Z8xz"; // AccessKeyId

        $accessKeySecret = "uc1yk8n92QKr2MfaBJ50zzxe81MoCy"; // AccessKeySecret

        // 暂时不支持多Region
        $region = "cn-hangzhou";

        // 服务结点
        $endPointName = "cn-hangzhou";


        if(static::$acsClient == null) {

            //初始化acsClient,暂不支持region化
            $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);

            // 增加服务结点
            DefaultProfile::addEndpoint($endPointName, $region, $product, $domain);

            // 初始化AcsClient用于发起请求
            static::$acsClient = new DefaultAcsClient($profile);
        }
        return static::$acsClient;
    }

    public function actionSendsms(){
         // 初始化SendSmsRequest实例用于设置发送短信的参数
        $request = new SendSmsRequest();
        	
        $phone = Yii::$app->request->post('phone');
        //可选-启用https协议
        $request->setProtocol("https");

        // 必填，设置短信接收号码
        $request->setPhoneNumbers($phone);

        // 必填，设置签名名称，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $request->setSignName("兰连久");

        // 必填，设置模板CODE，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $request->setTemplateCode("SMS_135797818");

        // 可选，设置模板参数, 假如模板中存在变量需要替换则为必填项
        $request->setTemplateParam(json_encode(array(  // 短信模板中字段的值
            "code"=>"12345",
            "product"=>"dsd"
        ), JSON_UNESCAPED_UNICODE));

        // 可选，设置流水号
        $request->setOutId("yourOutId");

        // 选填，上行短信扩展码（扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段）
        $request->setSmsUpExtendCode("1234567");

        // 发起访问请求
        $acsResponse = static::getAcsClient()->getAcsResponse($request);

        $key = 'sms_send_cache_no';   
        $value = json_encode($acsResponse);   
        $expire = 100;   
        yii::$app->cache->set($key, $value, $expire);   
       
        return json_encode($acsResponse);

    }

}
