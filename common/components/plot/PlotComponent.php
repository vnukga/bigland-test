<?php


namespace common\components\plot;

use common\components\plot\exceptions\PlotNotFoundException;
use common\components\plot\formatters\ArrayDataProviderFormatter;
use common\components\plot\formatters\FormatterInterface;
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

    /**
     * Класс для форматирования данных
     *
     * @var FormatterInterface
     */
    private FormatterInterface $formatter;

    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->getPlotsService = new GetPlotsService();
        $this->formatter = new ArrayDataProviderFormatter();
    }

    /**
     * Запуск компонента
     *
     * @param array|null $cadastralNumbers
     * @return array|models\Plot|mixed|ActiveRecord[]|null
     * @throws PlotNotFoundException
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function run(array $cadastralNumbers = null)
    {
        $plots = $this->getPlotsService->run($cadastralNumbers);
        if(!$plots) {
            throw new PlotNotFoundException();
        }
        return $this->formatter->format($plots);
    }}