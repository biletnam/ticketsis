<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ticketproduct".
 *
 * @property integer $id
 * @property integer $fk_ticket
 * @property integer $fk_customerproduct
 *
 * @property Customerproduct $fkCustomerproduct
 * @property Tickets $fkTicket
 */
class Ticketproduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticketproduct';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_ticket', 'fk_customerproduct'], 'integer'],
            [['fk_customerproduct'], 'exist', 'skipOnError' => true, 'targetClass' => Customerproduct::className(), 'targetAttribute' => ['fk_customerproduct' => 'id']],
            [['fk_ticket'], 'exist', 'skipOnError' => true, 'targetClass' => Tickets::className(), 'targetAttribute' => ['fk_ticket' => 'ticketid']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_ticket' => 'Fk Ticket',
            'fk_customerproduct' => 'Fk Customerproduct',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkCustomerproduct()
    {
        return $this->hasOne(Customerproduct::className(), ['id' => 'fk_customerproduct']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkTicket()
    {
        return $this->hasOne(Tickets::className(), ['ticketid' => 'fk_ticket']);
    }
}
