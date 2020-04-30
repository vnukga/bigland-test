<?php


namespace frontend\controllers;

use common\components\plot\exceptions\PlotNotFoundException;
use frontend\models\PlotForm;
use Yii;
use yii\web\Controller;

/**
 * Контроллер для работы с данными участков на сайте
 *
 * @package frontend\controllers
 */
class PlotController extends Controller
{
    /**
     * Стартовая страница приложения
     *
     * @return string
     */
    public function actionIndex()
    {
        $plots = [];
        $model = new PlotForm();
        if($model->load(Yii::$app->request->post())){
            $cadastralNumbers = explode(',', $model->cadastralNumbers);
            try {
                $plots = Yii::$app->plot->run($cadastralNumbers);
            } catch (PlotNotFoundException $exception) {
                Yii::$app->session->setFlash('error', 'Данные не найдены');
                $plots = [];
            }
        }
        return $this->render('index',[
            'dataProvider' => $plots,
            'model' => $model
        ]);
    }
}