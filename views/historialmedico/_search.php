<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HistorialMedicoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="historial-medico-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'enf_cardiaca') ?>

    <?= $form->field($model, 'ale_alimentaria') ?>

    <?= $form->field($model, 'ale_cutanea') ?>

    <?= $form->field($model, 'otras_limit') ?>

    <?php // echo $form->field($model, 'cancer') ?>

    <?php // echo $form->field($model, 'enf_endocrina') ?>

    <?php // echo $form->field($model, 'otras') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
