<?php
/**
 * @file    main-sidebar.php.
 * @author  Agiel K. Saputra
 * @date    5/8/2015
 * @time    3:13 PM
 */

use yii\helpers\Html;
use cebe\gravatar\Gravatar;
use codezeen\yii2\adminlte\widgets\MainSidebar;

?>

<aside class="main-sidebar">
    <section class="sidebar">

        <?php if (!Yii::$app->user->isGuest) { ?>
            <div class="user-panel">
                <div class="pull-left image">
                    <?php echo Gravatar::widget([
                        'email'   => Yii::$app->user->identity->email,
                        'options' => [
                            'alt'   => Yii::$app->user->identity->username,
                            'class' => 'img-circle'
                        ],
                        'size'    => 45
                    ]); ?>
                </div>
                <div class="pull-left info">
                    <p><?= Yii::$app->user->identity->username; ?></p>
                    <?= Html::a('<i class="fa fa-circle text-success"></i>' . Yii::t('app', 'Online'), ['/user/profile']); ?>
                </div>
            </div>
        <?php } ?>

        <?php
        $admin_site_menu[0] = ['label' => Yii::t('app', 'MAIN NAVIGATION'), 'options' => ['class' => 'header'], 'template' => '{label}'];
        $admin_site_menu[1] = ['label' => Yii::t('app', 'Dashboard'), 'icon' => '<i class="fa fa-dashboard"></i>', 'options' => ['class' => 'treeview'], 'items' => [
            ['icon' => '<i class="fa fa-circle-o"></i>', 'label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
            ['icon' => '<i class="fa fa-circle-o"></i>', 'label' => Yii::t('app', 'Update'), 'url' => '#'],
        ]];
        $admin_site_menu[5] = ['label' => Yii::t('app', 'Multilevel'), 'icon' => '<i class="fa fa-share"></i>', 'options' => ['class' => 'treeview'], 'items' => [
            ['icon' => '<i class="fa fa-circle-o"></i>', 'label' => Yii::t('app', 'Level One'), 'url' => '#'],
            ['icon' => '<i class="fa fa-circle-o"></i>', 'label' => Yii::t('app', 'Level One'), 'url' => '#', 'items' => [
                ['icon' => '<i class="fa fa-circle-o"></i>', 'label' => Yii::t('app', 'Level Two'), 'url' => '#'],
                ['icon' => '<i class="fa fa-circle-o"></i>', 'label' => Yii::t('app', 'Level Two'), 'url' => '#'],
                ['icon' => '<i class="fa fa-circle-o"></i>', 'label' => Yii::t('app', 'Level Two'), 'url' => '#'],
            ]],
            ['icon' => '<i class="fa fa-circle-o"></i>', 'label' => Yii::t('app', 'Level One'), 'url' => '#'],
        ]];
        $admin_site_menu[2] = ['label' => Yii::t('app', 'Post'), 'icon' => '<i class="fa fa-thumb-tack"></i>', 'options' => ['class' => 'treeview'], 'items' => [
            ['icon' => '<i class="fa fa-circle-o"></i>', 'label' => Yii::t('app', 'All Post'), 'url' => '#', 'badge' => '13'],
            ['icon' => '<i class="fa fa-circle-o"></i>', 'label' => Yii::t('app', 'Add New Post'), 'url' => '#'],
            ['icon' => '<i class="fa fa-circle-o"></i>', 'label' => Yii::t('app', 'Categories'), 'url' => '#'],
            ['icon' => '<i class="fa fa-circle-o"></i>', 'label' => Yii::t('app', 'Tags'), 'url' => '#'],
        ]];
        $admin_site_menu[10] = ['label' => Yii::t('app', 'User'), 'icon' => '<i class="fa fa-user"></i>', 'options' => ['class' => 'treeview'], 'items' => [
            ['icon' => '<i class="fa fa-circle-o"></i>', 'label' => Yii::t('app', 'Login'), 'url' => ['/site/login'], 'visible' => Yii::$app->user->isGuest],
            ['icon' => '<i class="fa fa-circle-o"></i>', 'label' => Yii::t('app', 'Logout'), 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post'], 'visible' => !Yii::$app->user->isGuest],
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
        ?>
    </section>
</aside>
