<?php

namespace common\models;

use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ConstellationSearch represents the model behind the search form of `common\models\Constellation`.
 */
final class ConstellationSearch extends Constellation
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id', 'status', 'type'], 'integer'],
            [['coordinates', 'title', 'en_title', 'description', 'en_description', 'image', 'user_photo'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios(): array
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with a search query applied
     *
     * @throws InvalidConfigException
     */
    public function search(array $params): ActiveDataProvider
    {
        $query = Constellation::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider(['query' => $query]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'coordinates', $this->coordinates])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'en_title', $this->en_title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'en_description', $this->en_description])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'user_photo', $this->user_photo]);

        return $dataProvider;
    }
}
