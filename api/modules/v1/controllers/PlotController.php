<?php


namespace api\modules\v1\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\Response;

/**
 * Контроллер, отдающий данные по участкам через api
 *
 * @package api\modules\v1\controllers
 */
class PlotController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['application/json'] = Response::FORMAT_JSON;
        return $behaviors;
    }

    /**
     * Возвращает данные по участкам из БД
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return Yii::$app->plot->run();
    }
}