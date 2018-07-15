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
        '/RET/backend/web/plugins/bootstrap/css/bootstrap.min.css',
        '/RET/backend/web/libs/font-awesome.min.css',
        '/RET/backend/web/libs/ionicons.min.css',
        '/RET/backend/web/statics/dist/css/AdminLTE.min.css',
        '/RET/backend/web/statics/dist/css/skins/_all-skins.min.css',
        '/RET/backend/web/plugins/iCheck/flat/blue.css',
        '/RET/backend/web/plugins/morris/morris.css',
        '/RET/backend/web/plugins/jvectormap/jquery-jvectormap-1.2.2.css',
        '/RET/backend/web/plugins/datepicker/datepicker3.css',
        '/RET/backend/web/plugins/daterangepicker/daterangepicker.css',
        '/RET/backend/web/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
        '/RET/backend/web/plugins/datatables/dataTables.bootstrap.css',
        '/RET/backend/web/plugins/bootstrap-table/css/bootstrap-table.min.css',
        '/RET/backend/web/plugins/bootstrap-dialog/bootstrap-dialog.min.css',
        '/RET/backend/web/plugins/zTree/zTreeStyle/zTreeStyle.css',
        '/RET/backend/web/plugins/select2/select2.css',
        '/RET/backend/web/css/style.min.css',
    ];
    public $js = [
        '/RET/backend/web/plugins/jQuery/jquery-2.2.3.min.js',
        '/RET/backend/web/plugins/form/jquery.form.min.js',
        '/RET/backend/web/plugins/bootstrap/js/bootstrap.min.js',
        '/RET/backend/web/plugins/chartjs/Chart.min.js',
        '/RET/backend/web/libs/raphael-min.js',
        '/RET/backend/web/plugins/morris/morris.min.js',
        '/RET/backend/web/plugins/sparkline/jquery.sparkline.min.js',
        '/RET/backend/web/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
        '/RET/backend/web/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
        '/RET/backend/web/plugins/knob/jquery.knob.js',
        '/RET/backend/web/plugins/jQueryUI/jquery-ui.min.js',
        '/RET/backend/web/libs/moment.min.js',
        '/RET/backend/web/plugins/daterangepicker/daterangepicker.js',
        '/RET/backend/web/plugins/datepicker/bootstrap-datepicker.js',
        '/RET/backend/web/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
        '/RET/backend/web/plugins/slimScroll/jquery.slimscroll.min.js',
        '/RET/backend/web/plugins/fastclick/fastclick.js',
        '/RET/backend/web/plugins/datatables/jquery.dataTables.min.js',
        '/RET/backend/web/plugins/datatables/dataTables.bootstrap.min.js',
        '/RET/backend/web/plugins/treeview/bootstrap-treeview.min.js',
        '/RET/backend/web/plugins/bootstrap-table/bootstrap-table.min.js',
        '/RET/backend/web/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js',
        '/RET/backend/web/plugins/bootstrap-extensions/tableExport.min.js',
        '/RET/backend/web/plugins/bootstrap-extensions/bootstrap-table-export/bootstrap-table-export.js',
        '/RET/backend/web/plugins/bootstrap-extensions/toolbar/bootstrap-table-toolbar.js',
        '/RET/backend/web/plugins/bootstrap-dialog/bootstrap-dialog.min.js',
        '/RET/backend/web/statics/dist/js/app.min.js',
        '/RET/backend/web/plugins/angular/1.6.1/angular.js',
        '/RET/backend/web/plugins/html5Validate/jquery-html5Validate-min.js',
        '/RET/backend/web/plugins/zTree/jquery.ztree.all-3.5.min.js',
        '/RET/backend/web/plugins/zTree/jquery.ztree.core.min.js',
        '/RET/backend/web/plugins/zTree/jquery.ztree.exedit.min.js',
        '/RET/backend/web/plugins/select2/select2.min.js',
        'http://api.map.baidu.com/api?v=2&ak=hvkoceANhFDRoMuI7noiOQFmjRMGTNFP',

        '/RET/backend/web/js/iov-min.js'
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
