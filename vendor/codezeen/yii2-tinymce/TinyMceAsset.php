<?php
/**
 * @file    TinyMceAsset.php.
 * @author  Agiel K. Saputra
 * @date    5/6/2015
 * @time    2:31 PM
 */

namespace codezeen\yii2\tinymce;

use yii\web\AssetBundle;

/**
 * Class TinyMceAsset.
 * Register tinymce assets.
 *
 * @package codezeen\yii2\tinymce
 */
class TinyMceAsset extends AssetBundle{

    /**
     * @var string
     */
    public $sourcePath = '@bower/tinymce-dist';

    /**
     * @var array
     */
    public $js = [
        'tinymce.min.js',
        'jquery.tinymce.min.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}

