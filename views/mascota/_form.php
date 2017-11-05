<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Mascota */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mascota-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_nac')->textInput() ?>

    <?= $form->field($model, 'chip')->textInput() ?>

    <?= $form->field($model, 'id_raza')->textInput() ?>

    <?= $form->field($model, 'sexo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'esterilizado')->textInput() ?>

    <?= $form->field($model, 'fecha_ult_celo')->textInput() ?>

    <?= $form->field($model, 'adoptado')->textInput() ?>

    <?= $form->field($model, 'id_protectora')->textInput() ?>

    <?= $form->field($model, 'id_historial_medico')->textInput() ?>

    <?= $form->field($model, 'id_historial_comportamiento')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
