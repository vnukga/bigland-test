<?php


namespace common\components\plot\services;


use common\components\plot\exceptions\PlotNotFoundException;
use yii\data\ArrayDataProvider;

/**
 * Служба, возвращающая список участков в виде ArrayDataProvider'а
 *
 * @package common\components\plot\services
 */
class GetPlotsAsDataProviderService implements ServiceInterface
{

    /**
     * Запуск службы
     *
     * @param array|null $plots
     * @return ArrayDataProvider
     * @throws PlotNotFoundException
     */
    public function run(array $plots = null)
    {
        if(!$plots) {
            throw new PlotNotFoundException();
        }
        $dataProvider = new ArrayDataProvider([
            'allModels' => $plots
        ]);
        return $dataProvider;
    }
}