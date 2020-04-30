<?php


namespace frontend\models;


use yii\base\Model;

/**
 * Модель для поиска данных об участках
 *
 * @package frontend\models
 */
class PlotForm extends Model
{
    /**
     * Кадастровые номера
     *
     * @var string
     */
    public string $cadastralNumbers = '';

    public function rules()
    {
        return [
            [['cadastralNumbers'], 'string']
        ];
    }

    public function attributeLabels()
    {
        return [
            'cadastralNumbers' => 'Кадастровые номера'
        ];
    }
}