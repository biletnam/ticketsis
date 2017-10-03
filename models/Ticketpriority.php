<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ticketpriority".
 *
 * @property integer $ticketpriorityid
 * @property string $priority
 *
 * @property Tickets[] $tickets
 */
class Ticketpriority extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticketpriority';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['priority'], 'required'],
            [['priority'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ticketpriorityid' => 'Ticketpriorityid',
            'priority' => 'Priority',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::className(), ['fk_ticketpriority' => 'ticketpriorityid']);
    }
}
