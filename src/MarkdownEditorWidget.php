<?php
namespace WangNingkai\MarkdownEditor;

use yii\bootstrap\InputWidget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Inflector;
use yii\web\JsExpression;


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
            'watch' => true,
            'emoji' => true,
            'syncScrolling' => true,
            'searchReplace' => true,
            'taskList' => true,
            'tocm' => true,
            'tex' => true,
            'flowChart' => true,
            'sequenceDiagram' => true,
            'height' => "600",
            'htmlDecode' => "style,script,iframe|on*",
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