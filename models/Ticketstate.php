<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ticketstate".
 *
 * @property integer $stateid
 * @property string $ticketstate
 *
 * @property Tickets[] $tickets
 */
class Ticketstate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticketstate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ticketstate'], 'required'],
            [['ticketstate'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'stateid' => 'Stateid',
            'ticketstate' => 'Ticketstate',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::className(), ['fk_state' => 'stateid']);
    }
}
