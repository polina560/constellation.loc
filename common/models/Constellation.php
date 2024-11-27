<?php

namespace common\models;

use common\models\AppActiveRecord;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%constellation}}".
 *
 * @property int         $id
 * @property string      $coordinates
 * @property string      $title
 * @property string      $en_title
 * @property string      $description
 * @property string      $en_description
 * @property string      $image
 * @property string|null $user_photo
 * @property int         $status
 * @property int         $type
 * @property string|null $token_id       ID в виде токена
 */

#[Schema(properties: [
    new Property(property: 'token_id', type: 'integer'),
    new Property(property: 'coordinates', type: 'string'),
    new Property(property: 'title', type: 'string'),
    new Property(property: 'en_title', type: 'string'),
    new Property(property: 'description', type: 'string'),
    new Property(property: 'en_description', type: 'string'),
    new Property(property: 'image', type: 'string'),
    new Property(property: 'user_photo', type: 'string'),
])]
class Constellation extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%constellation}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['coordinates', 'title', 'en_title', 'description', 'en_description', 'image'], 'required'],
            [['status', 'type'], 'integer'],
            [['coordinates', 'title', 'en_title', 'description', 'en_description', 'image', 'user_photo', 'token_id'], 'string', 'max' => 255]
        ];
    }

    final public function fields(): array
    {
        return [
            'token_id',
            'coordinates',
            'title',
            'en_title',
            'description',
            'en_description',
            'image',
            'user_photo'
        ];
    }



    /**
     * {@inheritdoc}
     */
    final public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'coordinates' => Yii::t('app', 'Coordinates'),
            'title' => Yii::t('app', 'Title'),
            'en_title' => Yii::t('app', 'English Title'),
            'description' => Yii::t('app', 'Description'),
            'en_description' => Yii::t('app', 'English Description'),
            'image' => Yii::t('app', 'Image'),
            'user_photo' => Yii::t('app', 'User Photo'),
            'status' => Yii::t('app', 'Status'),
            'type' => Yii::t('app', 'Type'),
            'token_id' => Yii::t('app', 'Token ID'),
        ];
    }

    public function beforeSave($insert): bool
    {
        if(empty($this->token_id)){
            $token = Yii::$app->security->generateRandomString(15);;
            $this->token_id = $token;

        }
        return parent::beforeSave($insert);
    }
}
