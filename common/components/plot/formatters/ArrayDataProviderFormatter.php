<?php


namespace common\components\plot\formatters;

use yii\data\ArrayDataProvider;

/**
 * Класс, для преобразования данных в ArrayDataProvider
 *
 * @package common\components\plot\formatters
 */
class ArrayDataProviderFormatter implements FormatterInterface
{

    /**
     * Метод для форматирования данных
     *
     * @param $data
     * @return mixed
     */
    public function format($data)
    {
        $dataProvider = new ArrayDataProvider([
            'allModels' => $data
        ]);
        return $dataProvider;
    }
}