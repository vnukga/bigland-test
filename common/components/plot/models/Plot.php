<?php

namespace common\components\plot\models;

use yii\db\ActiveRecord;

/**
 * Класс для таблицы 'plot'
 *
 * @property int $id
 * @property string $cadastralNumber
 * @property string $address
 * @property float $price
 * @property float $area
 */
class Plot extends ActiveRecord
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
            [['address'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cadastralNumber' => 'Кадастровый номер',
            'address' => 'Адрес',
            'price' => 'Стоимость',
            'area' => 'Площадь',
        ];
    }
}
