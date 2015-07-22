Yii2 TinyMCE
==========================
TinyMCE Extension For Yii2 With Compressor

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist codezeen/yii2-tinymce "*"
```

or add

```
"codezeen/yii2-tinymce": "*"
```

to the require section of your `composer.json` file.


Usage
-----
### Register Asset Only
If you only want to use the asset, you only need to write the following code to the file view:
```php
<?= \codezeen\yii2\tinymce\TinyMceAsset::register($this); ?>
```

### Usage With ActiveForm
```php
<?= $form->field($model, 'attribute')->widget(
    TinyMce::className(),
    [
        'settings'        => [
            'language'               => 'en',
            'plugins'                => [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "template paste textcolor"
            ],
            'toolbar'                => "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor",
            'toolbar_items_size'     => 'small',
            'image_advtab'           => true,
            'relative_urls'          => false,
        ],
    ]
) ?>
```

### Usage Without ActiveForm
```php
<?= TinyMce::widget([
    // ...
]) ?>
```

### Usage With Compressor
Add the following code to the controller
```php
public function actions()
{
    return [
        'tinyMceCompressor' => [
            'class' => TinyMceCompressorAction::className(),
        ],
    ];
}
```
Then, add route to configured action to widget options:

```php
$form->field($model, 'content')->widget(
    TinyMce::className(),
    ['compressorRoute' => 'controller/tiny-mce-compressor']
)
```

More Information About TinyMCE
-----
Please, check the [TinyMCE plugin site](http://www.tinymce.com/wiki.php/Configuration) documentation for more options.
