Yii2 Admin-LTE 2
=================

Admin-LTE-2 Extension for Yii2

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist codezeen/yii2-adminlte "*"
```

or add

```
"codezeen/yii2-adminlte": "*"
```

to the require section of your `composer.json` file.


Register Asset
-----
### Register Asset directly

Register asset directly to view file.

```php
<?= \codezeen\yii2\adminlte\AdminLteAsset::register($this); ?>
```

### Register Asset via Asset Bundle
```php
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
        'js/site.js',
    ];
    public $depends = [
        'codezeen\yii2\adminlte\AdminLteAsset',
    ];
}
```

Render Sidebar Left
-----
```php
$admin_site_menu[0] = ['label' => Yii::t('app', 'MAIN NAVIGATION'), 'options' => ['class' => 'header'], 'template' => '{label}'];
$admin_site_menu[1] = ['label' => Yii::t('app', 'Dashboard'), 'icon' => '<i class="fa fa-dashboard"></i>', 'options' => ['class' => 'treeview'], 'items' => [
    ['icon' => '<i class="fa fa-circle-o"></i>', 'label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
]];
$admin_site_menu[10] = ['label' => Yii::t('app', 'User'), 'icon' => '<i class="fa fa-user"></i>', 'options' => ['class' => 'treeview'], 'items' => [
    ['icon' => '<i class="fa fa-circle-o"></i>', 'label' => Yii::t('app', 'Login'), 'url' => ['/site/login'], 'visible' => Yii::$app->user->isGuest],
    ['icon' => '<i class="fa fa-circle-o"></i>', 'label' => Yii::t('app', 'Logout'), 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post'], 'visible' => !Yii::$app->user->isGuest],
]];
$admin_site_menu[2] = ['label' => Yii::t('app', 'Posts'), 'icon' => '<i class="fa fa-thumb-tack"></i>', 'options' => ['class' => 'treeview'], 'items' => [
    ['icon' => '<i class="fa fa-circle-o"></i>', 'label' => Yii::t('app', 'All Posts'), 'url' => ['/site/index'], 'badge' => 13],
]];
// Short the menu
ksort($admin_site_menu);
echo MainSidebar::widget([
    'options'         => ['class' => 'sidebar-menu'],
    'labelTemplate'   => '<a href="#">{icon}<span>{label}</span>{right-icon}{badge}</a>',
    'linkTemplate'    => '<a href="{url}" {linkOptions}>{icon}<span>{label}</span>{right-icon}{badge}</a>',
    'submenuTemplate' => "\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
    'activateParents' => true,
    'items'           => $admin_site_menu,
]);
```

Using Theme
-----
Edit your config/main.php with the following:
```php
'components'    => [
    // Other components
    'view'      => [
        'theme'     => [
            'pathMap'   => [
                '@app/views' => '@vendor/codezeen/yii2-adminlte/theme'
            ],
        ],
    ],
    // Other components
]
```
Change Skin and Layout
-----
### Edit config/params.php
The default skin configured on params.php. You can override the skin on the controller.
```php
return [
    // Others params
    'bodyClass' => 'skin-blue sidebar-mini',
    // Other params
];
```
### In Controller Action
```php
 public function actionSignup()
{
    $this->layout = 'blank';
    Yii::$app->params['bodyClass'] = 'login-page';
}
```

