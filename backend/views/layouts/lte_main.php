<?php
//use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use backend\assets\AppAsset;
AppAsset::register($this);

$this->title = '首页';

$system_menus = Yii::$app->user->identity->getSystemMenus();
$system_rights = Yii::$app->user->identity->getSystemRights();
$route = $this->context->route;
$absoluteUrl = Yii::$app->request->absoluteUrl;
$funInfo = isset($system_rights[$this->context->route]) == true ? $system_rights[$route] : null;

$otherMenu = true;

//检查是否为主菜单，主菜单不需要添加返回上一层菜单
if(isset($funInfo) == true && $funInfo['entry_url'] != $this->context->route){
    $referrer = Yii::$app->request->referrer;
    if(empty($referrer) == false){
        $referrer = urldecode($referrer);
        $system_menus_current = isset(Yii::$app->session['system_menus_current']) == true ? Yii::$app->session['system_menus_current'] : [];
        //检查当前URL是否已经在导航菜单中
        $inCurrent = false;
        foreach($system_menus_current as $key=>$m){
            if($inCurrent == true){
                unset($system_menus_current[$key]);

            }
            else if($m['route'] == $route){
                $inCurrent = true;
            }
        }
        if($inCurrent == false){
            $funLast = count($system_menus_current) > 0 ? $system_menus_current[count($system_menus_current) - 1] : null;
            // 检查当前url是否和前一个相同，判断是否刷新
            if($funLast['route'] != $route){
                $system_menus_current[] = ['url'=>$absoluteUrl,'route'=>$route, 'right_name'=>$funInfo['right_name']];

            }
        }
        Yii::$app->session['system_menus_current'] = $system_menus_current;
    }
    else{
        $otherMenu = false;
    }
}else{
    $otherMenu = false;
};

if($otherMenu == false){
    Yii::$app->session['system_menus_current'] = null;
}

?>
<?php $this->beginPage()?>

<!DOCTYPE html>
<html>
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="<?=Url::base()?>/favicon.ico">
    <title><?=$this->title?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php $this->head()?>

    <?php if(isset($this->blocks['header']) == true):?>
      <?= $this->blocks['header'] ?>
    <?php endif;?>
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <?php $this->beginBody() ?>
      <section id="container" >
        <div class="wrapper">
            <!-- 头部 -->
            <header class="main-header left-header">
              
              <a href="#" class="logo">
                <span class="logo-mini"><b>S</b>HP</span>
                <span class="logo-lg"><b>SHP</b></span>
              </a>
          
              <nav class="navbar navbar-static-top">
                <!-- 菜单栏显、隐 -->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                  <span class="sr-only"></span>
                </a>
                <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav" >
                    <!-- 个人信息 -->
                    <li class="dropdown user-menu notifications-menu" >
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo Yii::$app->user->identity->head_img_url;?>" class="user-image" alt=""> 
                        <span class="hidden-xs"><?php echo Yii::$app->user->identity->uname;?>&nbsp;&nbsp;</span>
                        <span class="fa fa-caret-down"></span>
                      </a>
                        <ul class="dropdown-menu" style="width: 150px;height:100px;">
                        <li>
                          <ul class="menu">
                            <li><a href="<?=Url::toRoute('site/edit-user')?>"><i class="fa fa-cog"></i> 修改资料</a></li>
                            <li><a href="<?=Url::toRoute('site/logout')?>" data-method="post"><i class="fa fa-sign-out"></i> 退出</a></li>
                          </ul>
                      </ul>
                    </li>
                  </ul>
                </div>
              </nav>
            </header>

            <!--菜单栏 -->
            <aside class="main-sidebar">
              <section class="sidebar">
                <ul class="sidebar-menu">
                  <li <?=$route == 'site/index' ?  ' class="active" ' : ''?>>
                    <a href="<?=Url::to(['site/index'])?>">
                    <i class="fa fa-home"></i> 
                    <span>首页</span>
                    </a>
                  </li>
                  <?php 
                    foreach($system_menus as $menu){
                        $funcList = $menu['funcList'];
                        $isMenuActive = '';
                        $isMenuIcon = 'fa-angle-left';
                        $isTreeView = count($funcList) > 0 ? "treeview" : "";
                        $menuHtml = '<li class="#isMenuActive#'. $isTreeView .'">'; // active 
                        $menuHtml .= '   <a href="#">';
                        $menuHtml .= '   <i class="fa '.$menu['menuicon'].'"></i> <span>'. $menu['label'] .'</span>';
                        $menuHtml .= '   <span class="pull-right-container">';
                        $menuHtml .= '       <i class="fa #isMenuIcon# pull-right"></i>';
                        $menuHtml .= '   </span>';
                        $menuHtml .= '   </a>';
                      if($isTreeView != ""){
                          $menuHtml .= '<ul class="treeview-menu">';
                          foreach($funcList as $fun){
                              $isActive = $fun['url'] == $funInfo['entry_url'] ? 'class="active"' : ''; //'. $isActive .'
                              $menuHtml .= '<li '. $isActive .'><a href="'.Url::to([$fun['url']]).'"><i class="fa fa-circle-o"></i>'. $fun['label'] .'</a></li>';
                              if(empty($isMenuActive) == true && $isActive != ""){
                                  $isMenuActive = 'active ';
                                  $isMenuIcon = 'fa-angle-down';
                              }
                          }
                          $menuHtml .= '</ul>';
                      }
                        $menuHtml .= '</li>';
                        $menuHtml = str_replace('#isMenuActive#', $isMenuActive, $menuHtml);
                        $menuHtml = str_replace('#isMenuIcon#', $isMenuIcon, $menuHtml);
                      
                        echo $menuHtml;
                    }
                  ?>
                </ul>
              </section>
            </aside>

            <!-- 右边内容顶部栏 -->
            <div class="content-wrapper">
              <section class="content-header no-padding">
                <h6 style="margin-top:0px;border-bottom:  1px solid;">  
                  <ol class="breadcrumb breadcrumb-quirk no-margin">
                      <li><a href="<?=Url::toRoute('site/index')?>"><i class="fa fa-home"></i> 首页</a></li>
                    <?php
                    if(isset($funInfo['module_name']) == true && isset($funInfo['menu_name']) == true){
                        echo '<li><a href="#">'.$funInfo['module_name'].'</a></li>';
                        echo '<li><a href="'.Url::toRoute($funInfo['entry_url']).'">'.$funInfo['menu_name'].'</a></li>';
                    }
                    ?>
                  </ol>
                </h6>
              </section>
                <?= $content ?>
            </div>
        </div>
      </section>
    <?php $this->endBody()?>
  </body>

  <?php if(isset($this->blocks['footer']) == true):?>
    <?= $this->blocks['footer'] ?>
  <?php endif;?>
</html>
<?php $this->endPage()?>

