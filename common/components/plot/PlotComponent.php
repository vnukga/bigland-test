<?php


namespace common\components\plot;

use common\components\plot\services\GetPlotsService;
use common\components\plot\services\ServiceInterface;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;
use yii\httpclient\Exception;

/**
 * Компонент для работы с участками
 *
 * @package common\components\plot
 */
class PlotComponent extends Component
{
    /**
     * Служба для получения данных по участкам
     *
     * @var GetPlotsService|ServiceInterface
     */
    private ServiceInterface $getPlotsService;

    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->getPlotsService = new GetPlotsService();
    }

    /**
     * Запуск компонента
     *
     * @param array|null $cadastralNumbers
     * @return array|models\Plot|mixed|ActiveRecord[]|null
     * @throws InvalidConfigException
     * @throws Exception
     * @throws exceptions\PlotNotFoundException
     */
    public function run(array $cadastralNumbers = null)
    {
        return $this->getPlotsService->run($cadastralNumbers);
    }
}