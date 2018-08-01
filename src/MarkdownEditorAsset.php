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
        'css/editormd.min.css',
        'css/editormd.logo.css',
        'css/editormd.preview.css',
        'css/editormd.custom.css'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}