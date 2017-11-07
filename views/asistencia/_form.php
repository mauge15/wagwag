<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Asistencia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asistencia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_mascota')->textInput() ?>

    <?= $form->field($model, 'llegada')->textInput() ?>

    <?= $form->field($model, 'salida')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
