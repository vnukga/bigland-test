<?php


namespace api\modules\v1\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\Response;

class PlotController extends Controller
{
    public function actionIndex()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return Yii::$app->plot->run();
    }
}