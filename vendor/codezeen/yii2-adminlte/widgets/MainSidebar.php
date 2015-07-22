<?php
/**
 * @file    MainSidebar.php.
 * @author  Agiel K. Saputra
 * @date    5/8/2015
 * @time    2:42 PM
 */

namespace codezeen\yii2\adminlte\widgets;

use Yii;
use yii\widgets\Menu;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/**
 * Class MainSidebar.
 * Create main sidebar for admin-lte.
 * ```php
 * $admin_site_menu[0] = ['label' => Yii::t('app', 'MAIN NAVIGATION'), 'options' => ['class' => 'header'], 'template'
 * => '{label}'];
 * $admin_site_menu[1] = ['label' => Yii::t('app', 'Dashboard'), 'icon' => '<i class="fa fa-dashboard"></i>', 'options'
 * => ['class' => 'treeview'], 'items' => [
 *     ['icon' => '<i class="fa fa-circle-o"></i>', 'label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
 *     ['icon' => '<i class="fa fa-circle-o"></i>', 'label' => Yii::t('app', 'Update'), 'url' => '#'],
 * ]];
 * // Shorting menu by index
 * ksort($admin_site_menu);
 * echo MainSidebar::widget([
 *     'options'         => ['class' => 'sidebar-menu'],
 *     'linkTemplate'    => '<a href="{url}">{icon}<span>{label}</span>{right-icon}{badge}</a>',
 *     'submenuTemplate' => "\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
 *     'activateParents' => true,
 *     'items'           => $admin_site_menu,
 * ]);
 * ```
 *
 * @author Agiel K. Saputra
 */
class MainSidebar extends Menu
{
    /**
     * @var string
     */
    public $linkTemplate = '<a href="{url}" {linkOptions}>\n{icon}\n{label}\n{right-icon}\n{badge}</a>';
    /**
     * @var string
     */
    public $labelTemplate = '{icon}\n{label}\n{badge}';
    /**
     * @var string
     */
    public $submenuTemplate = "\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n";
    /**
     * @var string
     */
    public $badgeTag = 'small';
    /**
     * @var string
     */
    public $badgeClass = 'badge pull-right';
    /**
     * @var string
     */
    public $badgeBgClass = 'bg-green';
    /**
     * @var string
     */
    public $parentRightIcon = '<i class="fa fa-angle-left pull-right"></i>';

    /**
     * @inheritdoc
     */
    protected function renderItem($item)
    {
        $item['badgeOptions'] = isset($item['badgeOptions']) ? $item['badgeOptions'] : [];

        if (!ArrayHelper::getValue($item, 'badgeOptions.class')) {
            $bg = isset($item['badgeBgClass']) ? $item['badgeBgClass'] : $this->badgeBgClass;
            $item['badgeOptions']['class'] = $this->badgeClass . ' ' . $bg;
        }

        if (isset($item['items']) && !isset($item['right-icon'])) {
            $item['right-icon'] = $this->parentRightIcon;
        }

        if (isset($item['url'])) {
            $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);

            return strtr($template, [
                '{badge}'          => isset($item['badge']) ? Html::tag('small', $item['badge'], $item['badgeOptions']) : '',
                '{icon}'           => isset($item['icon']) ? $item['icon'] : '',
                '{right-icon}'     => isset($item['right-icon']) ? $item['right-icon'] : '',
                '{url}'            => Url::to($item['url']),
                '{label}'          => $item['label'],
                '{linkOptions}'    => isset($item['linkOptions']) ? Html::renderTagAttributes($item['linkOptions']): ''
            ]);
        } else {
            $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);

            return strtr($template, [
                '{badge}'          => isset($item['badge']) ? Html::tag('small', $item['badge'], $item['badgeOptions']) : '',
                '{icon}'           => isset($item['icon']) ? $item['icon'] : '',
                '{right-icon}'     => isset($item['right-icon']) ? $item['right-icon'] : '',
                '{label}'          => $item['label'],
                '{linkOptions}'    => isset($item['linkOptions']) ? Html::renderTagAttributes($item['linkOptions']): ''
            ]);
        }
    }
}