<?php

namespace api\modules\v1\controllers;

use api\behaviors\returnStatusBehavior\JsonSuccess;
use common\models\Constellation;
use common\models\Image;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class ImageController extends AppController
{

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), ['auth' => ['except' => ['index', 'random', 'token']]]);
    }

    /**
     * Returns a list of Constellation's
     */
    #[Get(
        path: '/image/index',
        operationId: 'image-index',
        description: 'Возвращает список картинок',
        summary: 'Список картинок',
        security: [['bearerAuth' => []]],
        tags: ['image']
    )]
    #[JsonSuccess(content: [
        new Property(
            property: 'image', type: 'array',
            items: new Items(ref: '#/components/schemas/Image'),
        )
    ])]
    public function actionIndex(): array
    {
        $query = Image::find();

        $provider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->returnSuccess([
            'images' => $provider,
        ]);


    }
}
