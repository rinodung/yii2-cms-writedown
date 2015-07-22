<?php
/**
 * @file    TinyMce.php.
 * @author  Agiel K. Saputra
 * @date    5/7/2015
 * @time    2:31 PM
 */

namespace codezeen\yii2\tinymce;

use Yii;
use yii\widgets\InputWidget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/**
 * Class TinyMce
 *
 * @package codezeen\yii2\tinymce
 */
class TinyMce extends InputWidget
{
    /** @var array Supported languages */
    private static $languages = [
        'ar', 'ar_SA', 'bg_BG', 'bn_BD', 'bs', 'ca', 'cs', 'cy', 'da', 'de', 'de_AT', 'el', 'es', 'es_MX', 'et', 'eu',
        'fa', 'fa_IR', 'fi', 'fo', 'fr_FR', 'gl', 'he_IL', 'hr', 'hu_HU', 'hy', 'id', 'it', 'ja', 'ka_GE', 'ko_KR',
        'lb', 'lt', 'lv', 'ml', 'mn_MN', 'nb_NO', 'nl', 'pl', 'pt_BR', 'pt_PT', 'ro', 'ru', 'si_LK', 'sk', 'sl_SI', 'sr',
        'sv_SE', 'ta', 'ta_IN', 'th_TH', 'tr_TR', 'tt', 'ug', 'uk', 'uk_UA', 'vi', 'vi_VN', 'zh_CN', 'zh_TW', 'en_GB',
        'km_KH', 'tg', 'az', 'en_CA', 'is_IS', 'be', 'dv', 'kk', 'ml_IN', 'gd',
    ];

    /**
     * @var array Default configuration of widget, can be overridden
     */
    private static $defaultSettings = [
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
        'spellchecker_languages' => "+Русский=ru",
    ];

    /**
     * @var array to override the settings
     */
    public $settings = [];

    /**
     * @var string|bool Setting language fo widget
     */
    public $language = false;

    /**
     * For example here could be url to yandex spellchecker service.
     * http://speller.yandex.net/services/tinyspell
     * More info about it here: http://api.yandex.ru/speller/doc/dg/tasks/how-to-spellcheck-tinymce.xml
     *
     * Or you can build own spellcheking service using code provided by moxicode:
     * http://www.tinymce.com/download/download.php
     *
     * @var bool|string|array URL or an action route that can be used to create a URL or false if no url
     */
    public $spellcheckerUrl = false;

    /** @var bool|string Route to compressor action */
    public $compressorRoute = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->settings = ArrayHelper::merge(static::$defaultSettings, $this->settings);

        if ($this->language === false) {
            $this->settings['language'] = Yii::$app->language;
        } else {
            $this->settings['language'] = $this->language;
        }

        if (!in_array($this->settings['language'], self::$languages)) {
            $lang = false;
            foreach (self::$languages as $i) {
                if (strpos($this->settings['language'], $i)) {
                    $lang = $i;
                }
            }
            if ($lang !== false) {
                $this->settings['language'] = $lang;
            } else {
                $this->settings['language'] = 'en';
            }
        }

        $this->settings['language'] = strtr($this->settings['language'], '_', '-');

        $assetsDir = $this->getView()->getAssetManager()->getBundle(TinyMceAsset::className())->baseUrl;
        $this->settings['script_url'] = "{$assetsDir}/tiny_mce.js";

        if ($this->spellcheckerUrl !== false) {
            $this->settings['plugins'][] = 'spellchecker';

            if (is_array($this->spellcheckerUrl)) {
                $this->settings['spellchecker_rpc_url'] = Url::toRoute($this->spellcheckerUrl);
            } else {
                $this->settings['spellchecker_rpc_url'] = $this->spellcheckerUrl;
            }

        }

    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }

        if (isset($this->model)) {
            echo Html::activeTextarea($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textArea($this->name, $this->value, $this->options);
        }

        $this->registerScripts();
    }

    /**
     * Register assets of TinyMCE
     */
    private function registerScripts()
    {
        $id = $this->options['id'];

        $view = $this->getView();

        if ($this->compressorRoute === false) {
            TinyMceAsset::register($view);
        } else {
            $opts = [
                'files'  => 'jquery.tinymce',
                'source' => defined('YII_DEBUG') && YII_DEBUG,
            ];
            $opts["plugins"] = strtr(implode(',', $this->settings['plugins']), [' ' => ',']);

            if (isset($this->settings['theme'])) {
                $opts["themes"] = $this->settings['theme'];
            }

            $opts["languages"] = $this->settings['language'];
            $view->registerJsFile(
                TinyMceCompressorAction::scripUrl($this->compressorRoute, $opts),
                [
                    'depends' => [
                        'yii\web\JqueryAsset'
                    ]
                ]
            );
        }

        $settings = Json::encode($this->settings);

        $this->getView()->registerJs("$('#{$id}').tinymce({$settings});");
    }
}
