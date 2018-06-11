<?php
namespace graychen\yii2\basic\auth;

use yii\base\Module as BaseModule;

/**
 * portal module definition class
 */
class Module extends BaseModule
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'graychen/yii2/basic/auth/controllers';
    /**
     *
     * @var string source language for translation
     */
    public $sourceLanguage = 'en-US';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }
    /**
     * Registers the translation files
     */
    protected function registerTranslations()
    {
        Yii::$app->i18n->translations['graychen/yii2/basic/auth/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => $this->sourceLanguage,
            'basePath' => '@graychen/yii2/basic/auth/messages',
            'fileMap' => [
                'graychen/yii2/basic/auth/app.php' => 'app.php',
            ],
        ];
    }
    /**
     * Translates a message. This is just a wrapper of Yii::t
     *
     * @see Yii::t
     *
     * @param $category
     * @param $message
     * @param array $params
     * @param null $language
     * @return string
     */
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('graychen/yii2/basic/auth/' . $category, $message, $params, $language);
    }
}
