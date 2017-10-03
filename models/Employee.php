<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property integer $employeeid
 * @property string $name
 * @property string $firstname
 * @property integer $active
 * @property integer $systemtype
 * @property string $companytype
 *
 * @property Tickets[] $tickets
 * @property Tickets[] $tickets0
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'firstname', 'active', 'systemtype', 'companytype'], 'required'],
            [['active', 'systemtype'], 'integer'],
            [['companytype'], 'string'],
            [['name', 'firstname'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'employeeid' => 'Employeeid',
            'name' => 'Name',
            'firstname' => 'Firstname',
            'active' => 'Active',
            'systemtype' => 'Systemtype',
            'companytype' => 'Companytype',
        ];
    }

       public function getFullName()
        {
                return $this->name.' '.$this->firstname;
        }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::className(), ['fk_creator' => 'employeeid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets0()
    {
        return $this->hasMany(Tickets::className(), ['fk_responsible' => 'employeeid']);
    }
}
