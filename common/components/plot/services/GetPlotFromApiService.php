<?php


namespace common\components\plot\services;

use common\components\plot\models\Plot;
use yii\base\InvalidConfigException;
use yii\httpclient\Client;
use yii\httpclient\Exception;

/**
 * Служба для получения данных об участках с внешнего апи
 *
 * @package common\components\plot\services
 */
class GetPlotFromApiService implements ServiceInterface
{
    /**
     * HTTP-клиент
     *
     * @var Client
     */
    private Client $client;

    /**
     * Адрес api-сервера
     *
     * @var string
     */
    private string $url = 'http://pkk.bigland.ru/api/test/plots';

    /**
     * Метод запроса
     *
     * @var string
     */
    private string $method = 'GET';

    public function __construct()
    {
        $this->client = new Client([
            'baseUrl' => $this->url
        ]);
    }

    /**
     * Запуск службы
     *
     * @param string|null $cadastralNumber
     * @return array|null
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function run(string $cadastralNumber = null) : ?array
    {
        if($cadastralNumber && $response = $this->getApiResponse($cadastralNumber)){
            $plot = $this->createPlotFromResponse($response);
            return [$plot];
        }
        return null;
    }

    /**
     * Получение данных от api
     *
     * @param string $cadastralNumber
     * @return string
     * @throws InvalidConfigException
     * @throws Exception
     */
    private function getApiResponse(string $cadastralNumber) : ?string
    {
        $response = $this->client->createRequest()
            ->setMethod($this->method)
            ->setFormat(Client::FORMAT_JSON)
            ->setData([
                'collection' => [
                    'plots' => [
                        $cadastralNumber
                    ]
                ]
            ])
            ->send();
        if(!$response->isOk) {
            return null;
        }
        return $response->getContent();
    }

    /**
     * Создание записи в БД
     *
     * @param string $response
     * @return Plot
     */
    private function createPlotFromResponse(string $response) : Plot
    {
        $plotFromApi = json_decode($response)[0];
        $plot = new Plot([
            'cadastralNumber' => $plotFromApi->number,
            'address' => $plotFromApi->data->attrs->address,
            'price' => $plotFromApi->data->attrs->cad_cost,
            'area' => $plotFromApi->data->attrs->area_value
        ]);
        $plot->save();
        return $plot;
    }
}