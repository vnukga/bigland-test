<?php


namespace common\components\plot\formatters;

/**
 * Интерфейс для классов, форматирующих данные
 *
 * @package common\components\plot\formatters
 */
interface FormatterInterface
{
    /**
     * Метод для форматирования данных
     *
     * @param $data
     * @return mixed
     */
    public function format($data);
}