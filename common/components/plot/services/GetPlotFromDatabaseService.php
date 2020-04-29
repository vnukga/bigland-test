<?php


namespace common\components\plot\services;


use common\components\plot\models\Plot;
use yii\db\ActiveRecord;

/**
 * Служба для получения записей из БД
 *
 * @package common\components\plot\services
 */
class GetPlotFromDatabaseService implements ServiceInterface
{
    /**
     * Возвращает запись из БД по кадастровому номеру, либо все записи, если номер не указан
     *
     * @param string $cadastralNumber
     * @return array|Plot|mixed|ActiveRecord[]|null
     */
    public function run(string $cadastralNumber = null)
    {
        if($cadastralNumber){
            return Plot::findOne(['cadastralNumber' => $cadastralNumber]);
        }
        return Plot::find()->all();
    }
}