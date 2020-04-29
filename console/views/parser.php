<?php

use yii\console\widgets\Table;

/**
 * Вид для отображения данных по участкам в консоли
 */

$rows = [];
foreach ($plots->allModels as $plot) {
    $rows[] = [
        $plot->cadastralNumber,
        $plot->address,
        $plot->price,
        $plot->area
    ];
}

return Table::widget([
    'headers' => ['CN', 'Address', 'Price', 'Area'],
    'rows' => $rows,
]);