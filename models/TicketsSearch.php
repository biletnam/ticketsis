<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tickets;

/**
 * TicketsSearch represents the model behind the search form about `app\models\Tickets`.
 */
class TicketsSearch extends Tickets
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ticketid', 'fk_creator', 'fk_ticketpriority', 'fk_responsible', 'fk_state'], 'integer'],
            [['date', 'desc', 'datetimecreated','fk_customer'], 'safe'],
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
        $query = Tickets::find();

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

         $query->joinWith('fkCustomer');

        // grid filtering conditions
        $query->andFilterWhere([
            'ticketid' => $this->ticketid,
            'fk_creator' => $this->fk_creator,
            'fk_ticketpriority' => $this->fk_ticketpriority,
            'fk_responsible' => $this->fk_responsible,
            'fk_state' => $this->fk_state,
            'datetimecreated' => $this->datetimecreated,
        ]);

        $query->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'desc', $this->desc])
             ->andFilterWhere(['like', 'customers.customer', $this->fk_customer]);


        return $dataProvider;
    }
}
