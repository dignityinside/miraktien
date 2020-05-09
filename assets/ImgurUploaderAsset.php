<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Imgur uploader asset
 *
 * @package app\assets
 *
 * @author Alexander Schilling
 */
class ImgurUploaderAsset extends AssetBundle
{

    /** @var array */
    public $css = [
        'css/imgur-uploader.css',
    ];

    /** @var array */
    public $js = [
        'js/imgur-uploader.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
