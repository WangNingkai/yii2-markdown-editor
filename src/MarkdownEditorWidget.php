<?php
namespace WangNingkai\MarkdownEditor;

use yii\bootstrap\InputWidget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Inflector;


class MarkdownEditorWidget extends InputWidget
{
    /**
     * editor options
     * @var array
     */
    public $clientOptions = [];

    /**
     * Init the Widget
     */
    public function init()
    {
        parent::init();
        if (!isset ($this->options ['id'])) {
            $this->options ['id'] = $this->getId();
        }
        $this->initClientOptions();
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        $textarea = $this->hasModel() ? Html::activeTextArea($this->model, $this->attribute, $this->options) : Html::textArea($this->name, $this->value, $this->options);

        $view = $this->getView();
        $id = $this->options ['id'];
        $editor = MarkdownEditorAsset::register($view);
        $this->clientOptions['path'] = $editor->baseUrl . '/lib/';

        $jsOptions = empty ($this->clientOptions) ? '' : Json::htmlEncode($this->clientOptions);

        $varName = Inflector::classify('editor' . $id);

        if ($this->clientOptions['emoji']) {
            $emoji = 'editormd.emoji = ' . Json::htmlEncode(['path' => 'http://www.webpagefx.com/tools/emoji-cheat-sheet/graphics/emojis/', 'ext' => ".png"]);
            $view->registerJs($emoji);
        }
        $view->registerJs("var editor{$id} = new editormd(\"{$varName}\", {$jsOptions});");
        echo '<div id="' . $varName . '">' . $textarea . '</div>';
    }

    /**
     * Init Client Options
     */
    public function initClientOptions()
    {
        $options = [
            'width' => '100%',
            'height' => "600",
            'theme' => 'default',
            'previewTheme' => 'default',
            'editorTheme' => 'base16-light',
//            'markdown' => '',
            'codeFold' => true, // 代码折叠
            'syncScrolling' => true, // 同步预览
            'saveHTMLToTextarea' => true,    // 保存 HTML 到 Textarea
            'searchReplace' => true, // 搜索
            'watch' => true, // 关闭预览
            'htmlDecode' => "style,script,iframe|on*",  // 开启 HTML 标签解析，为了安全性，默认不开启
            'toolbar ' => false,             //关闭工具栏
            'previewCodeHighlight' => false, // 关闭预览 HTML 的代码块高亮，默认开启
            'emoji' => true, // 表情
            'taskList' => true, // 任务栏
            'tocm           ' => true,         // Using [TOCM]
            'tex' => true,    // 开启科学公式TeX语言支持，默认关闭
            'flowChart' => true,             // 开启流程图支持，默认关闭
            'sequenceDiagram' => true,       // 开启时序/序列图支持，默认关闭,
            // 'dialogLockScreen' => false,   // 设置弹出层对话框不锁屏，全局通用，默认为true
            // 'dialogShowMask' => false,     // 设置弹出层对话框显示透明遮罩层，全局通用，默认为true
            // 'dialogDraggable' => false,    // 设置弹出层对话框不可拖动，全局通用，默认为true
            // 'dialogMaskOpacity' => 0.4,    // 设置透明遮罩层的透明度，全局通用，默认值为0.1
            // 'dialogMaskBgColor' => '#000', // 设置透明遮罩层的背景颜色，全局通用，默认为#fff
            'placeholder' => "欢迎使用MarkDown编辑器",
            'toolbarIcons' => [
                "undo", "redo", "|",
                "h1", "h2", "h3", "h4", "h5", "h6", "|",
                "bold", "del", "italic", "quote", "list-ul", "list-ol", "hr", "pagebreak", "|",
                "code", "preformatted-text", "code-block", "|",
                "image", "table", "link", "reference-link", "|",
                "datetime", "emoji", "html-entities", "|",
                "search", "goto-line", "ucwords", "uppercase", "lowercase", "clear", "|",
                "preview", "watch", "fullscreen", "|",
                "help"
            ],
        ];
        $this->clientOptions = array_merge($options, $this->clientOptions);
    }


}