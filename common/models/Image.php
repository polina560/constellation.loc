<?php

namespace common\models;

use common\models\AppActiveRecord;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%image}}".
 *
 * @property int    $id
 * @property string $image
 */

#[Schema(properties: [
    new Property(property: 'image', type: 'string'),
])]
class Image extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%image}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['image'], 'required'],
            [['image'], 'string', 'max' => 255]
        ];
    }

    /**
     * {@inheritdoc}
     */
    final public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'image' => Yii::t('app', 'Image'),
        ];
    }

    final public function fields(): array
    {
        return [
            'image'  => fn() => Yii::$app->request->hostInfo . $this->image,
        ];
    }
}
