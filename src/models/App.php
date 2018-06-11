<?php

namespace graychen\yii2\basic\auth\models;

use yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;
use yii\web\UploadedFile;
use yii\behaviors\TimestampBehavior;
use graychen\yii2\basic\auth\models\AppQuery;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

/**
 * This is the models class for table "{{%app}}".
 *
 * @property integer $id
 * @property string $app_name
 * @property string $app_icon
 * @property string $app_description
 * @property string $app_key
 * @property string $app_secret
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $status
 * @property string $package_name
 * @property boolean $deploy_status
 * @property UploadedFile $imageFile
 * @property \common\models\AppIosProfile $iosProfile
 */
class App extends ActiveRecord implements IdentityInterface
{
    const STATUS_VALID = 1; //正常
    const STATUS_INVALID = -1; //禁用

    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%app}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['app_name'], 'required'],
            [['created_at', 'updated_at', 'status'], 'integer'],
            [['app_name'], 'string', 'max' => 36],
            [['app_description'], 'string', 'max' => 125],
            [['app_key'], 'string', 'max' => 36],
            [['app_name', 'app_secret'], 'string', 'max' => 32],
            [
                ['imageFile'],
                'file',
                'skipOnEmpty' => true,
                'extensions' => 'png, jpg',
                'maxFiles' => 1,
                'maxSize' => 300000
            ],
            ['status', 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'id'),
            'app_name' => Yii::t('app', 'app name'),
            'app_icon' => Yii::t('app', 'app icon'),
            'app_description' => Yii::t('app', 'description'),
            'app_key' => Yii::t('app', 'app key'),
            'app_secret' => Yii::t('app', 'app secret'),
            'created_at' => Yii::t('app', 'create time'),
            'updated_at' => Yii::t('app', 'update time'),
            'status' => Yii::t('app', 'status'),
            'imageFile' => '上传图标',
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return AppQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AppQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }


    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            try {
                $uuid = Uuid::uuid3(Uuid::NAMESPACE_DNS, $this->app_name);
                $this->app_key = $uuid->toString();
            } catch (UnsatisfiedDependencyException $e) {
                $this->addError('app_name', $e->getMessage());
                return false;
            }
            $this->app_secret = Yii::$app->security->generateRandomString();
            $this->status = self::STATUS_VALID;
        }
        return parent::beforeSave($insert);
    }

    public static function getStatusList()
    {
        return [
            [0=>'开发状态'],
            [1=>'部署状态']
        ];
    }
}

