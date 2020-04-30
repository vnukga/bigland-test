<?php


namespace console\controllers;

use Yii;
use yii\console\Controller;

/**
 * Котроллер для получения данных по участкам через консоль
 *
 * @package console\controllers
 */
class ParserController extends Controller
{
    /**
     * Путь к файлу вида для рендеринга данных
     *
     * @var string
     */
    private string $view;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
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
        $plots = Yii::$app->plot->run($cadastralNumbers);
        $view = require $this->view;
        echo $view;
    }
}