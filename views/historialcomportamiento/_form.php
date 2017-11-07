<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HistorialComportamiento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="historial-comportamiento-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_mascota')->textInput() ?>

    <?= $form->field($model, 'ha_mordido')->textInput() ?>

    <?= $form->field($model, 'ha_sido_mordido')->textInput() ?>

    <?= $form->field($model, 'miedo_perro')->textInput() ?>

    <?= $form->field($model, 'id_temperamento')->textInput() ?>

    <?= $form->field($model, 'juega_perros')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'juega_personas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'persona_desconocida')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'otra_info')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
