<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
$temperamento_list= ArrayHelper::map($listTemperamento,'id','descripcion');

/* @var $this yii\web\View */
/* @var $model app\models\HistorialComportamiento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="historial-comportamiento-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'ha_mordido')->textInput() ?>
    <?= $form->field($model, 'ha_sido_mordido')->textInput() ?>
    <?= $form->field($model, 'miedo_perro')->textInput() ?>
    <?= $form->field($model, 'id_temperamento')->radioList($temperamento_list) ?>
    <?= $form->field($model, 'juega_perros')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'juega_personas')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'persona_desconocida')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'otra_info')->textInput(['maxlength' => true]) ?>
    <?php /* Html::hiddenInput('HistorialComportamiento[id_mascota]',$idMascota,['id' => 'historialcomportamiento-id_mascota','name' => 'HistorialComportamiento[id_mascota]']) */?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
