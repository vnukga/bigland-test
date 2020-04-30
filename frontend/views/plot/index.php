<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(['id' => 'plot-form']); ?>

<?= $form->field($model, 'cadastralNumbers')->textInput(['autofocus' => true]) ?>

<div class="form-group">
    <?= Html::submitButton('Получить данные', ['class' => 'btn btn-primary', 'name' => 'plot-button']) ?>
</div>

<?php ActiveForm::end(); ?>

<?php if($dataProvider !== []): ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'cadastralNumber',
            [
                'attribute' => 'price',
                'value' => function($data){
                    return round($data->price, 2) . '&#8381;';
                },
                'format' => 'html'
            ],
            [
                'attribute' => 'area',
                'value' => function($data){
                    return round($data->area, 2) . 'м&#178;';
                },
                'format' => 'html'
            ],
        ],
    ]) ?>

<?php endif; ?>