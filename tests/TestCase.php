<?php
namespace tests;

use Yii;
use PHPUnit\Framework\TestCase as BaseTestCase;
use yii\base\Exception;
use yii\helpers\ArrayHelper;

class TestCase extends BaseTestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->mockWebApplication();
        $this->createTestDbData();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->destroyTestDbData();
        $this->destroyWebApplication();
    }

    protected function mockWebApplication($config = [], $appClass = '\yii\web\Application')
    {
        return new $appClass(ArrayHelper::merge([
            'id' => 'testapp',
            'basePath' => __DIR__,
            'vendorPath' => $this->getVendorPath(),
            'components' => [
                'db' => [
                    'class' => 'yii\db\Connection',
                    'dsn' => 'mysql:host=localhost:3306;dbname=test',
                    'username' => 'root',
                    'password' => '',
                    'tablePrefix' => 'tb_'
                ],
                'i18n' => [
                    'translations' => [
                        '*' => [
                            'class' => 'yii\i18n\PhpMessageSource',
                        ]
                    ]
                ],
            ],
            'modules' => [
                'basic-auth' => [
                    'class' => 'graychen\yii2\basic\auth\Module',
                    'controllerNamespace' => 'graychen\yii2\basic\auth'
                ]
            ]
        ], $config));
    }
    /**
     * @return string vendor path
     */
    protected function getVendorPath()
    {
        return dirname(__DIR__) . '/vendor';
    }
    /**
     * Destroys application in Yii::$app by setting it to null.
     */
    protected function destroyWebApplication()
    {
        if (\Yii::$app && \Yii::$app->has('session', true)) {
            \Yii::$app->session->close();
        }
        \Yii::$app = null;
    }
    protected function destroyTestDbData()
    {
        $db = Yii::$app->getDb();
        $db->createCommand()->dropTable('tb_app')->execute();
    }
    protected function createTestDbData()
    {
        $db = Yii::$app->getDb();
        try {
            $db->createCommand()->createTable('tb_app', [
                'id' => 'pk',
                'app_name' => 'string(32) not null',
                'app_description' => 'string(125) not null',
                'app_key' => 'char(40) not null',
                'app_secret' => 'char(36) not null',
                'created_at' => 'integer not null',
                'updated_at' => 'integer not null',
                'status' => 'integer not null',
            ])->execute();
            $db->createCommand()->insert('tb_app', [
                'app_name' => 'test-app',
                'app_description' => 'test-account',
                'app_key' => 'username',
                'app_secret' => 'password',
                'created_at' => time(),
                'updated_at' => time(),
                'status' => 1,
            ])->execute();
        } catch (Exception $e) {
            return;
        }
    }
}
