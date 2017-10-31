<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customerproduct".
 *
 * @property integer $id
 * @property integer $fk_customer
 * @property integer $fk_product
 * @property string $serialnumber
 * @property string $year
 * @property string $location
 * @property string $wartung
 * @property string $w_schlauch
 * @property string $w_waschmittel
 * @property string $active
 *
 * @property Customers $fkCustomer
 * @property Product $fkProduct
 * @property Ticketproduct[] $ticketproducts
 */
class Customerproduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customerproduct';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_product','serialnumber', 'year', 'location', 'active'], 'required'],
            [['fk_customer', 'fk_product'], 'integer'],
            [['year'], 'safe'],
            [['wartung', 'w_schlauch', 'w_waschmittel'], 'string'],
            [['serialnumber'], 'string', 'max' => 30],
            [['location'], 'string', 'max' => 40],
            [['fk_customer'], 'exist', 'skipOnError' => true, 'targetClass' => Customers::className(), 'targetAttribute' => ['fk_customer' => 'customerid']],
            [['fk_product'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['fk_product' => 'productid']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fk_customer' => 'Fk Customer',
            'fk_product' => 'Fk Product',
            'serialnumber' => 'Seriennummer',
            'year' => 'Jahr',
            'location' => 'Standort',
            'wartung' => 'Wartung',
            'w_schlauch' => 'W Schlauch',
            'w_waschmittel' => 'W Waschmittel',
            'active' => 'Zustand',
        ];
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
    public function getFkProduct()
    {
        return $this->hasOne(Product::className(), ['productid' => 'fk_product']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketproducts()
    {
        return $this->hasMany(Ticketproduct::className(), ['fk_customerproduct' => 'id']);
    }


    public function  getfullName()    
    {
            return $this->serialnumber.' - ('.$this->location.')';
    }
}
