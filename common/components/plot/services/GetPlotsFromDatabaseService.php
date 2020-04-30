<?php


namespace common\components\plot\services;


use common\components\plot\models\Plot;
use yii\db\ActiveRecord;

/**
 * Служба для получения записей из БД
 *
 * @package common\components\plot\services
 */
class GetPlotsFromDatabaseService implements ServiceInterface
{
    /**
     * Возвращает все записи с данными по участкам
     *
     * @param string|null $cadastralNumber
     * @return ActiveRecord[]|null
     */
    public function run(string $cadastralNumber = null) : ?array
    {
        if($cadastralNumber){
            if($plot = Plot::findOne(['cadastralNumber' => $cadastralNumber])) {
                return [$plot];
            }
            return null;
        }
        return Plot::find()->all();
    }
}