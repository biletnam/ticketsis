<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Customerproduct;

/**
 * CustomerproductSearch represents the model behind the search form about `app\models\Customerproduct`.
 */
class CustomerproductSearch extends Customerproduct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_customer', 'fk_product', 'aktiv'], 'integer'],
            [['serialnumber', 'year', 'location', 'wartung', 'w_schlauch', 'w_waschmittel'], 'safe'],
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
        $query = Customerproduct::find();

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
            'id' => $this->id,
            'fk_customer' => $this->fk_customer,
            'fk_product' => $this->fk_product,
            'year' => $this->year,
            'aktiv' => $this->aktiv,
        ]);

        $query->andFilterWhere(['like', 'serialnumber', $this->serialnumber])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'wartung', $this->wartung])
            ->andFilterWhere(['like', 'w_schlauch', $this->w_schlauch])
            ->andFilterWhere(['like', 'w_waschmittel', $this->w_waschmittel]);

        return $dataProvider;
    }
}
