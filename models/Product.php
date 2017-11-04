<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $productid
 * @property integer $fk_producer
 * @property string $pname
 * @property string $comment
 * @property string $file
 *
 * @property Producer $fkProducer
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_producer', 'pname'], 'required'],
            [['fk_producer'], 'integer'],
            [['pname', 'comment', 'file'], 'string'],
            [['fk_producer'], 'exist', 'skipOnError' => true, 'targetClass' => Producer::className(), 'targetAttribute' => ['fk_producer' => 'producerid']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'productid' => 'Productid',
            'fk_producer' => 'Fk Producer',
            'pname' => 'Pname',
            'comment' => 'Comment',
            'file' => 'File',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkProducer()
    {
        return $this->hasOne(Producer::className(), ['producerid' => 'fk_producer']);
    }
}
