<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "plot".
 *
 * @property int $id
 * @property string $cadastralNumber
 * @property string $address
 * @property float $price
 * @property float $area
 */
class Plot extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plot';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cadastralNumber', 'address', 'price', 'area'], 'required'],
            [['price', 'area'], 'number'],
            [['cadastralNumber'], 'string', 'max' => 20],
            [['address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cadastralNumber' => Yii::t('app', 'Cadastral Number'),
            'address' => Yii::t('app', 'Address'),
            'price' => Yii::t('app', 'Price'),
            'area' => Yii::t('app', 'Area'),
        ];
    }
}
