<?php


namespace common\components\plot\services;

use common\components\plot\models\Plot;
use yii\base\InvalidConfigException;
use yii\httpclient\Exception;

/**
 * Служба, возвращающая данные по участкам
 *
 * @package common\components\plot\services
 */
class GetPlotsService implements ServiceInterface
{
    /**
     * Служба для получения данных по участкам из БД
     *
     * @var ServiceInterface
     */
    private ServiceInterface $databaseService;

    /**
     * Служба для получения данных от внешнего сервера
     *
     * @var ServiceInterface
     */
    private ServiceInterface $apiService;

    /**
     * Данные об участках
     *
     * @var array
     */
    private array $plots = [];

    public function __construct()
    {
        $this->databaseService = new GetPlotsFromDatabaseService();
        $this->apiService = new GetPlotFromApiService();
    }

    /**
     * Запуск службы
     *
     * @param array|null $cadastralNumbers
     * @return Plot[]|null
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function run(array $cadastralNumbers = null) : ?array
    {
        if(!$cadastralNumbers){
            $this->plots = $this->databaseService->run();
        } else {
            foreach ($cadastralNumbers as $cadastralNumber) {
                if($plot = $this->getPlot(trim($cadastralNumber))) {
                    $this->plots = array_merge($this->plots, $plot);
                }
            }
        }
        return  $this->plots;
    }

    /**
     * ПОлучение данных об участке
     *
     * @param string $cadastralNumber
     * @return array|null
     * @throws InvalidConfigException
     * @throws Exception
     */
    private function getPlot(string $cadastralNumber) : ?array
    {
        $plot = $this->databaseService->run($cadastralNumber);
        if(!$plot){
            $plot = $this->apiService->run($cadastralNumber);
        }
        return $plot;
    }
}