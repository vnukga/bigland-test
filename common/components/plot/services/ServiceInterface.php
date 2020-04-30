<?php


namespace common\components\plot\services;

/**
 * Интерфейс службы
 *
 * @package common\components\plot\services
 */
interface ServiceInterface
{
    /**
     * Запуск службы
     *
     * @return mixed
     */
    public function run() : ?array;
}