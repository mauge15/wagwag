<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Propietario;
use app\models\Mascota;

/* @var $this yii\web\View */
/* @var $model app\models\Asistencia */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="asistencia-form">
	<?php $model->llegada = date("H:m:s");?>

    <?php $form = ActiveForm::begin(); ?>

     <?= $form->field($model, 'fecha')->widget(\yii\jui\DatePicker::className(), [
    'language' => 'es',
    'inline' => 'true',
    'dateFormat' => 'dd-MM-yyyy',
  ]) ?>

  <?= $form->field($model, 'id_mascota')->hiddenInput(['value'=>$id_mascota])->label(false); ?>
  
    <?= $form->field($model, 'llegada')->textInput() ?>

    <?= $form->field($model, 'salida')->textInput() ?>

    <?= $form->field($model, 'tipo_asistencia')->radioList(array('1'=>'Mañana','2' => 'Tarde', '3'=> 'Día Completo', '4'=>'Por Horas'),array('separator'=>'<br>')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Aceptar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php
    ActiveForm::end(); 
    ?>

</div>
