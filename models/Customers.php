<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property integer $customerid
 * @property string $knr
 * @property string $customer
 * @property string $street
 * @property string $place
 * @property integer $zip
 * @property string $phone
 * @property string $comment
 *
 * @property Customercontact[] $customercontacts
 * @property Tickets[] $tickets
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['knr', 'customer', 'street', 'place', 'zip'], 'required'],
            [['zip'], 'integer'],
            [['comment'], 'string'],
            [['knr'], 'string', 'max' => 15],
            [['customer', 'street'], 'string', 'max' => 30],
            [['place', 'phone'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'customerid' => 'Customerid',
            'knr' => 'Knr',
            'customer' => 'Customer',
            'street' => 'Street',
            'place' => 'Place',
            'zip' => 'Zip',
            'phone' => 'Phone',
            'comment' => 'Comment',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomercontacts()
    {
        return $this->hasMany(Customercontact::className(), ['fk_customer' => 'customerid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::className(), ['fk_customer' => 'customerid']);
    }
}
