<?php
/**
 * @file    AdminLteAsset.php.
 * @author  Agiel K. Saputra
 * @date    5/8/2015
 * @time    3:19 PM
 */

namespace codezeen\yii2\adminlte;

/**
 * Class AdminLteAsset.
 * Register admin-lte-2 to view.
 *
 * @package codezeen\yii2\adminlte
 * @author  Agiel K. Saputra
 */
class AdminLteAsset extends \yii\web\AssetBundle{
    /**
     * @var string
     */
    public $sourcePath = '@bower/adminlte/dist';

    /**
     * @var array
     */
    public $css = [
        'css/AdminLTE.min.css',
        'css/skins/_all-skins.min.css'
    ];

    /**
     * @var array
     */
    public $js =[
        'js/app.min.js'
    ];

    /**
     * @var array
     */
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
        'codezeen\yii2\fastclick\FastClickAsset'
    ];
}