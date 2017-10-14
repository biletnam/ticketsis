<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tickets".
 *
 * @property integer $ticketid
 * @property integer $fk_customer
 * @property string $date
 * @property integer $fk_creator
 * @property integer $fk_ticketpriority
 * @property integer $fk_responsible
 * @property integer $fk_state
 * @property string $desc
 * @property string $datetimecreated
 *
 * @property Ticketproduct[] $ticketproducts
 * @property Employee $fkCreator
 * @property Customers $fkCustomer
 * @property Employee $fkResponsible
 * @property Ticketstate $fkState
 * @property Ticketpriority $fkTicketpriority
 */
class Tickets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tickets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_creator', 'fk_ticketpriority', 'fk_responsible', 'fk_state', 'desc', 'datetimecreated'], 'required'],
            [['fk_creator', 'fk_ticketpriority', 'fk_responsible', 'fk_state'], 'integer'],
            [['date', 'desc'], 'string'],
            [['datetimecreated'], 'safe'],
            [['fk_creator'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['fk_creator' => 'employeeid']],
            [['fk_customer'], 'exist', 'skipOnError' => true, 'targetClass' => Customers::className(), 'targetAttribute' => ['fk_customer' => 'customerid']],
            [['fk_responsible'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['fk_responsible' => 'employeeid']],
            [['fk_state'], 'exist', 'skipOnError' => true, 'targetClass' => Ticketstate::className(), 'targetAttribute' => ['fk_state' => 'stateid']],
            [['fk_ticketpriority'], 'exist', 'skipOnError' => true, 'targetClass' => Ticketpriority::className(), 'targetAttribute' => ['fk_ticketpriority' => 'ticketpriorityid']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ticketid' => 'Ticketid',
            'fk_customer' => 'Fk Customer',
            'date' => 'Date',
            'fk_creator' => 'Fk Creator',
            'fk_ticketpriority' => 'Fk Ticketpriority',
            'fk_responsible' => 'Fk Responsible',
            'fk_state' => 'Fk State',
            'desc' => 'Desc',
            'datetimecreated' => 'Datetimecreated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketproducts()
    {
        return $this->hasMany(Ticketproduct::className(), ['fk_ticket' => 'ticketid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkCreator()
    {
        return $this->hasOne(Employee::className(), ['employeeid' => 'fk_creator']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkCustomer()
    {
        return $this->hasOne(Customers::className(), ['customerid' => 'fk_customer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkResponsible()
    {
        return $this->hasOne(Employee::className(), ['employeeid' => 'fk_responsible']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkState()
    {
        return $this->hasOne(Ticketstate::className(), ['stateid' => 'fk_state']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkTicketpriority()
    {
        return $this->hasOne(Ticketpriority::className(), ['ticketpriorityid' => 'fk_ticketpriority']);
    }
}
