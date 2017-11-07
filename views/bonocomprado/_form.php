<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BonoComprado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bono-comprado-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_mascota')->textInput() ?>

    <?= $form->field($model, 'id_bono')->textInput() ?>

    <?= $form->field($model, 'id_propietario')->textInput() ?>

    <?= $form->field($model, 'fecha_compra')->textInput() ?>

    <?= $form->field($model, 'fecha_caducidad')->textInput() ?>

    <?= $form->field($model, 'dias_utilizados')->textInput() ?>

    <?= $form->field($model, 'dias_bono')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
