<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Customers;

/**
 * CustomersSearch represents the model behind the search form about `app\models\Customers`.
 */
class CustomersSearch extends Customers
{
    public $searchstring;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customerid', 'zip'], 'integer'],
            [['knr', 'customer', 'street', 'place', 'phone', 'comment'], 'safe'],
            [['searchstring'], 'safe'],
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
        $query = Customers::find();

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
            'customerid' => $this->customerid,
            'zip' => $this->zip,
        ]);

        $query
            ->orFilterWhere(['like', 'knr', $this->searchstring])
            ->orFilterWhere(['like', 'customer', $this->searchstring])
            ->orFilterWhere(['like', 'street', $this->searchstring])
            ->orFilterWhere(['like', 'place', $this->searchstring])
            ->orFilterWhere(['like', 'phone', $this->searchstring]);;
        /*
->andFilterWhere(['like', 'knr', $this->knr])
            ->andFilterWhere(['like', 'customer', $this->customer])
            ->andFilterWhere(['like', 'street', $this->street])
            ->andFilterWhere(['like', 'place', $this->place])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'comment', $this->comment])
        */
        return $dataProvider;
    }
}
