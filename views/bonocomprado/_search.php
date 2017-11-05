<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BonoCompradoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bono-comprado-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_mascota') ?>

    <?= $form->field($model, 'id_bono') ?>

    <?= $form->field($model, 'id_propietario') ?>

    <?= $form->field($model, 'fecha_compra') ?>

    <?php // echo $form->field($model, 'fecha_caducidad') ?>

    <?php // echo $form->field($model, 'dias_utilizados') ?>

    <?php // echo $form->field($model, 'dias_bono') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
