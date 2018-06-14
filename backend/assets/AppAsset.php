<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;
use yii\helpers\Url;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        '/SHP/backend/web/plugins/bootstrap/css/bootstrap.min.css',
        '/SHP/backend/web/libs/font-awesome.min.css',
        '/SHP/backend/web/libs/ionicons.min.css',
        '/SHP/backend/web/statics/dist/css/AdminLTE.min.css',
        '/SHP/backend/web/statics/dist/css/skins/_all-skins.min.css',
        '/SHP/backend/web/plugins/iCheck/flat/blue.css',
        '/SHP/backend/web/plugins/morris/morris.css',
        '/SHP/backend/web/plugins/jvectormap/jquery-jvectormap-1.2.2.css',
        '/SHP/backend/web/plugins/datepicker/datepicker3.css',
        '/SHP/backend/web/plugins/daterangepicker/daterangepicker.css',
        '/SHP/backend/web/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
        '/SHP/backend/web/plugins/datatables/dataTables.bootstrap.css',
        '/SHP/backend/web/plugins/bootstrap-table/css/bootstrap-table.min.css',
        '/SHP/backend/web/plugins/bootstrap-dialog/bootstrap-dialog.min.css',
        '/SHP/backend/web/css/style.min.css',
    ];
    public $js = [
        '/SHP/backend/web/plugins/jQuery/jquery-2.2.3.min.js',
        '/SHP/backend/web/plugins/form/jquery.form.min.js',
        '/SHP/backend/web/plugins/bootstrap/js/bootstrap.min.js',
        '/SHP/backend/web/plugins/chartjs/Chart.min.js',
        '/SHP/backend/web/libs/raphael-min.js',
        '/SHP/backend/web/plugins/morris/morris.min.js',
        '/SHP/backend/web/plugins/sparkline/jquery.sparkline.min.js',
        '/SHP/backend/web/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
        '/SHP/backend/web/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
        '/SHP/backend/web/plugins/knob/jquery.knob.js',
        '/SHP/backend/web/plugins/jQueryUI/jquery-ui.min.js',
        '/SHP/backend/web/libs/moment.min.js',
        '/SHP/backend/web/plugins/daterangepicker/daterangepicker.js',
        '/SHP/backend/web/plugins/datepicker/bootstrap-datepicker.js',
        '/SHP/backend/web/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
        '/SHP/backend/web/plugins/slimScroll/jquery.slimscroll.min.js',
        '/SHP/backend/web/plugins/fastclick/fastclick.js',
        '/SHP/backend/web/plugins/datatables/jquery.dataTables.min.js',
        '/SHP/backend/web/plugins/datatables/dataTables.bootstrap.min.js',
        '/SHP/backend/web/plugins/treeview/bootstrap-treeview.min.js',
        '/SHP/backend/web/plugins/bootstrap-table/bootstrap-table.min.js',
        '/SHP/backend/web/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js',
        '/SHP/backend/web/plugins/bootstrap-extensions/tableExport.min.js',
        '/SHP/backend/web/plugins/bootstrap-extensions/bootstrap-table-export/bootstrap-table-export.js',
        '/SHP/backend/web/plugins/bootstrap-extensions/toolbar/bootstrap-table-toolbar.js',
        '/SHP/backend/web/plugins/bootstrap-dialog/bootstrap-dialog.min.js',
        '/SHP/backend/web/statics/dist/js/app.min.js',
        '/SHP/backend/web/plugins/angular/1.6.1/angular.js',

        '/SHP/backend/web/js/iov-min.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    //导入当前页的功能js文件，注意加载顺序，这个应该最后调用
    public static function addPageScript($view, $jsfile) {
        $view->registerJsFile($jsfile, [AppAsset::className(), 'depends' => 'app\assets\AppAsset']);
    }
    
}
