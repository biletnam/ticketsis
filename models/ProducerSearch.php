<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Producer;

/**
 * ProducerSearch represents the model behind the search form about `app\models\Producer`.
 */
class ProducerSearch extends Producer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['producerid', 'onHomepage'], 'integer'],
            [['producer', 'description', 'homepage'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Producer::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'producerid' => $this->producerid,
            'onHomepage' => $this->onHomepage,
        ]);

        $query->andFilterWhere(['like', 'producer', $this->producer])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'homepage', $this->homepage]);

        return $dataProvider;
    }
}
