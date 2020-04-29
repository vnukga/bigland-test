<?php


namespace common\components\plot\services;

use common\components\plot\exceptions\PlotNotFoundException;
use common\components\plot\models\Plot;
use yii\base\InvalidConfigException;
use yii\httpclient\Exception;

/**
 * Получение данных участка по кадастровому номеру
 *
 * @package common\components\plot\services
 */
class GetPlotService implements ServiceInterface
{
    /**
     * Служба для получения данных от внешнего сервера
     *
     * @var GetPlotFromApiService|ServiceInterface
     */
    private ServiceInterface $getPlotFromApiService;

    public function __construct()
    {
        $this->getPlotFromApiService = new GetPlotFromApiService();
    }

    /**
     * Запуск службы
     *
     * @param string|null $cadastralNumber
     * @return Plot
     * @throws PlotNotFoundException
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function run(string $cadastralNumber = null) : Plot
    {
        if(!$cadastralNumber) {
            throw new PlotNotFoundException();
        }
        $plot = Plot::findOne(['cadastralNumber' => $cadastralNumber]);
        if(!$plot){
            $plot = $this->getPlotFromApiService->run($cadastralNumber);
        }
        return $plot;
    }
}