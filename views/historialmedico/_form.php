<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HistorialMedico */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="historial-medico-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'enf_cardiaca')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ale_alimentaria')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ale_cutanea')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'otras_limit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cancer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'enf_endocrina')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'otras')->textInput(['maxlength' => true]) ?>

    <?= Html::hiddenInput('HistorialMedico[idmascota]',$idMascota,['id'=>'historialmedico-idmascota','name'=>'HistorialMedico[idmascota]']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
