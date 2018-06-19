<?php
namespace backend\controllers;
use Yii;
use yii\web\Controller;
use yii\web\BadRequestHttpException;
use yii\helpers\Url;
use yii\web\ForbiddenHttpException;
use backend\models\AdminLog;
use common\utils\CommonFun;
use yii\helpers\StringHelper;
use yii\helpers\Inflector;
class BaseController extends Controller
{
    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if($this->verifyPermission($action) == true){
                return true;
            }
        }
        return false;
    }
    
    // 访问权限（请求地址权限验证）
    private function verifyPermission($action){
        $route = $this->route;
        // 检查是否已经登录
        if(Yii::$app->user->isGuest){
            $allowUrl = ['site/index', 'site/login'];
            if(in_array($route, $allowUrl) == false){
                $this->redirect(Url::toRoute('site/index'));
                return false;
            }
        }else{
            $system_rights = Yii::$app->user->identity->getSystemRights();
            $loginAllowUrl = [];
            $loginAllowUrl = ['site/index', 'site/logout', 'site/psw', 'site/psw-save'];
           
            // 查询/table/index不记录日志
            if((strstr($route,'/table')||(strstr($route,'/index')))){

                array_push($loginAllowUrl,$route);
            }

            if(in_array($route, $loginAllowUrl) == false){
               if((empty($system_rights) == true || empty($system_rights[$route]) == true)){
                    header("Content-type: text/html; charset=utf-8");
                    //exit('没有权限访问'.$route);
               }
               $rights = $system_rights[$route];
               if($route != 'system-log/index'){
                    $systemLog = new AdminLog();
                    $systemLog->url = $route;
                    $systemLog->controller_id = $action->controller->id;
                    $systemLog->action_id = $action->id;
                    $systemLog->module_name = $rights['module_name'];
                    $systemLog->func_name = $rights['menu_name'];
                    $systemLog->right_name = $rights['right_name'];
                    $systemLog->create_date = date('Y-m-d H:i:s');
                    $systemLog->create_user = Yii::$app->user->identity->uname;
                    $systemLog->client_ip = CommonFun::getClientIp();
                    $systemLog->save();
               }
            }
        }
        return true;
    }
    
    //获取后台控制器
    protected function getAllController(){
        $className = get_class($this);
        $mn = explode('\\', $className);
        array_pop($mn);
        $classNameSpace = implode('\\', $mn);
        $dir = dirname(__FILE__);
        $classfiles = glob ( $dir . "/*Controller.php" );
        $controllerDatas = [];
        foreach($classfiles as $file){
            $info = pathinfo($file);
            $controllerClass = $classNameSpace . '\\' . $info[ 'filename' ];
            $controllerDatas[$info[ 'filename' ]] = $controllerClass;
        }
        
        $rightActionData = [];
        foreach($controllerDatas as $c){
            if(StringHelper::startsWith($c, 'backend\controllers') == true && $c != 'backend\controllers\BaseController'){
                $controllerName = substr($c, 0, strlen($c) - 10);
                $cUrl = Inflector::camel2id(StringHelper::basename($controllerName));
                $methods = get_class_methods($c);
                $rightTree = ['text'=>$c, 'selectable'=>false, 'state'=>['checked'=>false], 'type'=>'r'];
                foreach($methods as $m){
                    if($m != 'actions' && StringHelper::startsWith($m, 'action') !== false){
                        $actionName = substr($m, 6, strlen($m));
                        $aUrl = Inflector::camel2id($actionName);
                        $actionTree = ['text'=>$aUrl . "($cUrl/$aUrl)", 'c'=>$cUrl, 'a'=>$aUrl, 'selectable'=>true, 'state'=>['checked'=>false], 'type'=>'a'];
                        if(isset($rightUrls[$cUrl.'/'.$aUrl]) == true){
                            $actionTree['state']['checked'] = true;
                            $rightTree['state']['checked'] = true;
                        }
                        $rightTree['nodes'][] = $actionTree;
                    }
                }
                $rightActionData[] = $rightTree;
            }
        }
        return $rightActionData;
    }
    
    //获取前台台控制器
    protected function getWebController(){
        $className = "frontend\\controllers\\WebNavController";
        $mn = explode('\\', $className);
        array_pop($mn);
        $classNameSpace = implode('\\', $mn);
        $dir = dirname(dirname(dirname(__FILE__))).'\\frontend\\controllers';
        
        $classfiles = glob ( $dir . "/*Controller.php" );
        $controllerDatas = [];
        foreach($classfiles as $file){
            $info = pathinfo($file);
            $controllerClass = $classNameSpace . '\\' . $info[ 'filename' ];
            $controllerDatas[$info[ 'filename' ]] = $controllerClass;
        }
        
        $rightActionData = [];
        foreach($controllerDatas as $c){
            if(StringHelper::startsWith($c, 'frontend\controllers') == true && $c != 'frontend\controllers\BaseController'){
                $controllerName = substr($c, 0, strlen($c) - 10);
                $cUrl = Inflector::camel2id(StringHelper::basename($controllerName));
                $methods = get_class_methods($c);
                $rightTree = ['text'=>$c, 'selectable'=>false, 'state'=>['checked'=>false], 'type'=>'r'];
                foreach($methods as $m){
                    if($m != 'actions' && StringHelper::startsWith($m, 'action') !== false){
                        $actionName = substr($m, 6, strlen($m));
                        $aUrl = Inflector::camel2id($actionName);
                        $actionTree = ['text'=>$aUrl . "($cUrl/$aUrl)", 'c'=>$cUrl, 'a'=>$aUrl, 'selectable'=>true, 'state'=>['checked'=>false], 'type'=>'a'];
                        if(isset($rightUrls[$cUrl.'/'.$aUrl]) == true){
                            $actionTree['state']['checked'] = true;
                            $rightTree['state']['checked'] = true;
                        }
                        $rightTree['nodes'][] = $actionTree;
                    }
                }
                $rightActionData[] = $rightTree;
            }
        }
        return $rightActionData;
    }

    //excel导入
    public function Getexcel($file){
        $file=$_FILES['file']['tmp_name'];
        Yii::import("special.extensions.PHPExcel");
        $PHPExcel = new PHPExcel();
        $PHPReader = new PHPExcel_Reader_Excel2007();
        if(!$PHPReader->canRead($file)){
            $PHPReader = new PHPExcel_Reader_Excel5();
            if(!$PHPReader->canRead($file)){
                return false;
            }
        }
        $PHPExcel = $PHPReader->load($file);
        $currentSheet = $PHPExcel->getSheet(0);//读取第一个工作表
        $allColumn = $currentSheet->getHighestColumn();//取得最大的列号
        $allRow = $currentSheet->getHighestRow();//取得一共有多少行
        /**从第二行开始输出，因为excel表中第一行为列名*/
        $arr=array();
        for($currentRow = 4;$currentRow <= $allRow;$currentRow++){
            /**从第A列开始输出*/
            for($currentColumn= 'A';$currentColumn<= $allColumn; $currentColumn++){

                $val = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65,$currentRow)->getValue(); /*ord()将字符转为十进制数*/

                /**如果输出汉字有乱码，则需将输出内容用iconv函数进行编码转换，如下将gb2312编码转为utf-8编码输出*/
                //$arr[$currentRow][]=  iconv('utf-8','gb2312', $val)."＼t";
                $arr[$currentRow][]=  trim($val);
            }
        }

        //删除全部为空的行
        foreach ($arr as $key=>$vals){
            $tmp = '';
            foreach($vals as $v){
                $tmp .= $v;
            }
            if(!$tmp) unset($arr[$key]);
        }

        return $arr;
    }

}

?>