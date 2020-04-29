<?php


namespace common\components\plot\services;

use common\components\plot\exceptions\PlotNotFoundException;
use common\components\plot\models\Plot;
use yii\base\InvalidConfigException;
use yii\data\ArrayDataProvider;
use yii\httpclient\Exception;

/**
 * Служба, возвращающая данные по участкам
 *
 * @package common\components\plot\services
 */
class GetPlotsService implements ServiceInterface
{
    /**
     * Служба для получения данных конкретного участка
     *
     * @var GetPlotService|ServiceInterface
     */
    private ServiceInterface $getPlotService;

    /**
     * Служба для получения данных участка из БД
     *
     * @var GetPlotFromDatabaseService|ServiceInterface
     */
    private ServiceInterface $getPlotFromDatabaseService;

    /**
     * Служба для получения данных в виде ArrayDataProvider
     *
     * @var GetPlotsAsDataProviderService|ServiceInterface
     */
    private ServiceInterface $getPlotsAsDataProviderService;

    /**
     * Данные об участках
     *
     * @var array
     */
    private array $plots = [];

    public function __construct()
    {
        $this->getPlotService = new GetPlotService();
        $this->getPlotFromDatabaseService = new GetPlotFromDatabaseService();
        $this->getPlotsAsDataProviderService = new GetPlotsAsDataProviderService();
    }

    /**
     * Запуск службы
     *
     * @param array|null $cadastralNumbers
     * @return array|Plot|mixed|ArrayDataProvider|Plot[]|null
     * @throws PlotNotFoundException
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function run(array $cadastralNumbers = null)
    {
        if(!$cadastralNumbers){
            return $this->getPlotFromDatabaseService->run();
        }

        foreach ($cadastralNumbers as $cadastralNumber) {
            $this->plots[] = $this->getPlotService->run($cadastralNumber);
        }
        $dataProvider = $this->getPlotsAsDataProviderService->run($this->plots);
        return  $dataProvider;
    }
}