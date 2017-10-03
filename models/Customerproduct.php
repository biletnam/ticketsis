<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customerproduct".
 *
 * @property integer $customerproductid
 * @property integer $fk_customer
 * @property integer $fk_product
 * @property string $serialnumber
 * @property string $year
 * @property string $location
 * @property string $wartung
 * @property string $w_schlauch
 * @property string $w_waschmittel
 * @property integer $aktiv
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
            [['customerproductid', 'fk_customer', 'fk_product', 'serialnumber', 'year', 'location', 'wartung', 'w_schlauch', 'w_waschmittel'], 'required'],
            [['customerproductid', 'fk_customer', 'fk_product', 'aktiv'], 'integer'],
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
            'customerproductid' => 'Customerproductid',
            'fk_customer' => 'Fk Customer',
            'fk_product' => 'Fk Product',
            'serialnumber' => 'Serialnumber',
            'year' => 'Year',
            'location' => 'Location',
            'wartung' => 'Wartung',
            'w_schlauch' => 'W Schlauch',
            'w_waschmittel' => 'W Waschmittel',
            'aktiv' => 'Aktiv',
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
        return $this->hasMany(Ticketproduct::className(), ['fk_customerproduct' => 'customerproductid']);
    }
}
