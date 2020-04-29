<?php


namespace console\controllers;


use common\components\plot\services\GetPlotsService;
use common\components\plot\services\ServiceInterface;
use yii\console\Controller;

/**
 * Котроллер для получения данных по участкам через консоль
 *
 * @package console\controllers
 */
class ParserController extends Controller
{
    /**
     * Служба для получения данных участков
     *
     * @var GetPlotsService|ServiceInterface
     */
    private ServiceInterface $getPlotsService;

    /**
     * Путь к файлу вида для рендеринга данных
     *
     * @var string
     */
    private string $view;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->getPlotsService = new GetPlotsService();
        $this->view = __DIR__ . '/../views/parser.php';
    }

    /**
     * Парсинг данных. Принимает на вход кадастровые номера участков, разделённые запятой.
     *
     * @param string $cadastralNumbers
     */
    public function actionParse(string $cadastralNumbers)
    {
        $cadastralNumbers = explode(',', $cadastralNumbers);
        $plots = $this->getPlotsService->run($cadastralNumbers);
        $view = require $this->view;
        echo $view;
    }
}