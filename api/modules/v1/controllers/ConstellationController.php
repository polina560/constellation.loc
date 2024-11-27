<?php

namespace api\modules\v1\controllers;

use api\behaviors\returnStatusBehavior\JsonSuccess;
use api\behaviors\returnStatusBehavior\RequestFormData;
use common\models\Constellation;
use common\models\Setting;
use OpenApi\Attributes\Get;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Post;
use OpenApi\Attributes\Property;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class ConstellationController extends AppController
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
        path: '/constellation/index',
        operationId: 'constellation-index',
        description: 'Возвращает список созвездий со статусом "одобрено"',
        summary: 'Список созвездий',
        security: [['bearerAuth' => []]],
        tags: ['constellation']
    )]
    #[JsonSuccess(content: [
        new Property(
            property: 'constellation', type: 'array',
            items: new Items(ref: '#/components/schemas/Constellation'),
        )
    ])]
    public function actionIndex(): array
    {

        $query = Constellation::find()->where(['status' => 10]);

        $provider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->returnSuccess([
            'constellation' => $provider,
        ]);


    }

    #[Get(
        path: '/constellation/random',
        operationId: 'constellation-random',
        description: 'Возвращает несколько пользовательских и подготовленных созвездий',
        summary: 'Случайные созвездия',
        security: [['bearerAuth' => []]],
        tags: ['constellation-random']
    )]
    #[JsonSuccess(content: [
        new Property(
            property: 'constellation', type: 'array',
            items: new Items(ref: '#/components/schemas/Constellation'),
        )
    ])]
    public function actionRandom(): array
    {
        $n = Setting::find()->where(['id' => 9])->one()->value;
        $i = Setting::find()->where(['id' => 10])->one()->value;

        $query1 = Constellation::find()->andWhere(['status' => 10])
            ->andWhere(['type' => 0])->orderBy(new Expression('rand()'))->limit($n);

        $query2 = Constellation::find()->andWhere(['status' => 10])
            ->andWhere(['type' => 10])->orderBy(new Expression('rand()'))->limit($i);

        $query1->union($query2);


        $provider = new ActiveDataProvider([
            'query' => $query1,
        ]);
        return $this->returnSuccess([
            'constellation' => $provider,
        ]);

    }

    #[Post(
        path: '/constellation/token',
        operationId: 'constellation-token',
        description: 'Возвращает конкретное созвездие по  токену',
        summary: 'Конкретное созвездие',
        security: [['bearerAuth' => []]],
        tags: ['constellation-token']
    )]
    #[RequestFormData(
        properties: [
            new Property(property: 'token_id', description: 'Токен ID', type: 'string')
        ]
    )]
    #[JsonSuccess(content: [
        new Property(
            property: 'constellation', type: 'array',
            items: new Items(ref: '#/components/schemas/Constellation'),
        )
    ])]
    public function actionToken(): array
    {
        $token_id = $this->getParameterFromRequest('token_id');

        if($token_id == null) {
            return [
                'success' => false,
                'data' => 'Нет параемтра ID Коллекции',
            ];
        }

        $query = Constellation::find()->andWhere(['token_id' => $token_id]);

        $provider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->returnSuccess([
            'teas' => $provider,

        ]);

    }

}
