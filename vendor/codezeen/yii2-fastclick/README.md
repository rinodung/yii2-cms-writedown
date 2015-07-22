Yii2 FastClick Asset
====================
FastClick Asset Bundle for Yii2

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist codezeen/yii2-fastclick "*"
```

or add

```
"codezeen/yii2-fastclick": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, use the following code in view to register asset :

```php
<?= \codezeen\yii2\fastclick\FastClickAsset::register($this); ?>
```

Or used as dependencies in asset bundle
```php
class AppAsset extends AssetBundle
{
    public $depends = [
        // ...
        'codezeen\yii2\fastclick\FastClickAsset',
        // ...
    ];
}
```

More Information
-----
Please, check [https://github.com/ftlabs/fastclick](https://github.com/ftlabs/fastclick) for more information about fastclick.js.
