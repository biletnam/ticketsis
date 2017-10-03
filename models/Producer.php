<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producer".
 *
 * @property integer $producerid
 * @property string $producer
 * @property string $description
 * @property string $homepage
 * @property integer $onHomepage
 *
 * @property Product[] $products
 */
class Producer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'producer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['producer', 'description', 'homepage', 'onHomepage'], 'required'],
            [['description', 'homepage'], 'string'],
            [['onHomepage'], 'integer'],
            [['producer'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'producerid' => 'Producerid',
            'producer' => 'Producer',
            'description' => 'Description',
            'homepage' => 'Homepage',
            'onHomepage' => 'On Homepage',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['fk_producer' => 'producerid']);
    }
}
