Markdown Editor For Yii2
==================

[![Latest Stable Version](https://poser.pugx.org/wangningkai/yii2-markdown-editor/v/stable)](https://packagist.org/packages/wangningkai/yii2-markdown-editor)
[![Total Downloads](https://poser.pugx.org/wangningkai/yii2-markdown-editor/downloads)](https://packagist.org/packages/wangningkai/yii2-markdown-editor)
[![Latest Unstable Version](https://poser.pugx.org/wangningkai/yii2-markdown-editor/v/unstable)](https://packagist.org/packages/wangningkai/yii2-markdown-editor)
[![License](https://poser.pugx.org/wangningkai/yii2-markdown-editor/license)](https://packagist.org/packages/wangningkai/yii2-markdown-editor)

优秀的Markdown编辑器
[Markdown Editor](https://github.com/WangNingkai/yii2-markdown-editor) For Yii2

安装
------------

建议通过 [composer](http://getcomposer.org/download/)进行安装.

命令行安装

```
php composer.phar require --prefer-dist yiier/yii2-editor.md "*"
```

在 `composer.json`文件中引入

```
"yiier/yii2-editor.md": "*"
```


使用
-----

安装完成后， 复制一下代码到需要使用的地方:

```php
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use WangNingkai\MarkdownEditor\MarkdownEditorWidget;

?>
<?= $form->field($model, 'content')->widget(MarkdownEditorWidget::className(), [
        'options'=>[// html attributes
            'id'=>'content'
        ],
        'clientOptions' => [
            'imageUpload' => true,
            'imageFormats' => ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'webp'],
            'imageUploadURL' => '/Action/to/upload',
        ]
    ]
) ?>

```