<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customercontact".
 *
 * @property integer $customercontactid
 * @property integer $fk_customer
 * @property string $firstname
 * @property string $lastname
 * @property string $phone
 * @property string $position
 * @property string $email
 *
 * @property Customers $fkCustomer
 */
class Customercontact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customercontact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lastname', 'phone', 'position'], 'required'],
            [['fk_customer'], 'integer'],
            [['firstname', 'lastname', 'position'], 'string', 'max' => 30],
            [['phone'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 40],
            [['fk_customer'], 'exist', 'skipOnError' => true, 'targetClass' => Customers::className(), 'targetAttribute' => ['fk_customer' => 'customerid']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customercontactid' => 'Customercontactid',
            'fk_customer' => 'Fk Customer',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'phone' => 'Phone',
            'position' => 'Position',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkCustomer()
    {
        return $this->hasOne(Customers::className(), ['customerid' => 'fk_customer']);
    }
}
