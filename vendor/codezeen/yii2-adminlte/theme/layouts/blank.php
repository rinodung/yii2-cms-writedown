<?php
/**
 * @file    blank.php.
 * @author  Agiel K. Saputra
 * @date    5/8/2015
 * @time    3:13 PM
 * @var $this \yii\web\View
 * @var $content string
 */

use yii\helpers\Html;
use codezeen\yii2\adminlte\AdminLteAsset;

AdminLteAsset::register($this);

/**
 * If you're using AdminLteAsset as dependency in AppAsset, then use AppAsset.
 * ```php
 * use \backend\assets\AppAsset
 * AppAsset::register($this)
 * ```
 * Yii::$app->params['bodyClass'] is a skin of admin-lte, ex: skin-blue, skin-black, etc.
 * You can define it in the controller or config/params.php
 */
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <?= Html::csrfMetaTags() ?>
    <title>WritesDown &raquo; <?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="<?= isset(Yii::$app->params['bodyClass'])? Yii::$app->params['bodyClass'] : "skin-blue sidebar-mini"; ?>">
    <?php $this->beginBody() ?>
    <?= $content; ?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
