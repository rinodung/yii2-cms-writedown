<?php
/**
 * @file    main.php.
 * @author  Agiel K. Saputra
 * @date    5/8/2015
 * @time    3:33 PM
 * @var $this \yii\web\View
 * @var $content string
 */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use codezeen\yii2\adminlte\widgets\Alert;

$this->beginContent('@app/views/layouts/blank.php');
?>
    <div class="wrapper">
        <?= $this->render('main-header'); ?>
        <?= $this->render('main-sidebar'); ?>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <?= $this->title; ?>
                </h1>
                <?= Breadcrumbs::widget([
                    'homeLink'     => [
                        'label' => Html::a( '<i class="fa fa-dashboard"></i> ' . Yii::t('app', 'Home'), Yii::$app->homeUrl ),
                    ],
                    'encodeLabels' => false,
                    'links'        => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </section>
            <section class="content clearfix">
                <?= Alert::widget() ?>
                <?= $content; ?>
            </section>
        </div>
        <?= $this->render('main-footer'); ?>
    </div>
<?php
$this->endContent();
