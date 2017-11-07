<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HistorialComportamientoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="historial-comportamiento-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_mascota') ?>

    <?= $form->field($model, 'ha_mordido') ?>

    <?= $form->field($model, 'ha_sido_mordido') ?>

    <?= $form->field($model, 'miedo_perro') ?>

    <?php // echo $form->field($model, 'id_temperamento') ?>

    <?php // echo $form->field($model, 'juega_perros') ?>

    <?php // echo $form->field($model, 'juega_personas') ?>

    <?php // echo $form->field($model, 'persona_desconocida') ?>

    <?php // echo $form->field($model, 'otra_info') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
