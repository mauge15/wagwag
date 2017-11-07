<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HistorialMedicoVacuna */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="historial-medico-vacuna-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_histmedico')->textInput() ?>

    <?= $form->field($model, 'id_vacuna')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
