<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ticketproduct;

/**
 * TicketproductSearch represents the model behind the search form about `app\models\Ticketproduct`.
 */
class TicketproductSearch extends Ticketproduct
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fk_ticket', 'fk_customerproduct'], 'integer'],
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
        $query = Ticketproduct::find();

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
            'fk_ticket' => $this->fk_ticket,
            'fk_customerproduct' => $this->fk_customerproduct,
        ]);

        return $dataProvider;
    }
}
