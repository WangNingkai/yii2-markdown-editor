<?php
namespace WangNingkai\MarkdownEditor;

use yii\web\AssetBundle;

class MarkdownEditorAsset extends AssetBundle
{
    public $sourcePath = '@vendor/wangningkai/yii2-markdown-editor/assets';
public $js = [
        'js/editormd.min.js',
    ];
    public $css = [
        'css/editormd.preview.css',
        'css/editormd.min.css',
        'css/editormd.logo.css',
        'css/editormd.custom.css'
    ];
    public $depends = [
        'frontend\assets\AppAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
    ];
}