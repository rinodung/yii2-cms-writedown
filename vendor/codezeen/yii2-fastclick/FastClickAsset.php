<?php
/**
 * @file    FastClickAsset.php.
 * @author  Agiel K. Saputra
 * @date    5/8/2015
 * @time    11:20 AM
 */

namespace codezeen\yii2\fastclick;

/**
 * Class FastClickAsset.
 * Register fastclick asset to view.
 *
 * @package codezeen\yii2\fastclick
 * @author  Agiel K. Saputra
 */
class FastClickAsset extends \yii\web\AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@bower/fastclick/lib';

    /**
     * @var array
     */
    public $js = [
        'fastclick.js',
    ];
}