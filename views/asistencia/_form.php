<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Propietario;
use app\models\BonoComprado;
use app\models\Bono;
use app\models\Mascota;
use yii\web\View;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Asistencia */
/* @var $form yii\widgets\ActiveForm */

$sql = "SELECT b.id as id, b2.tipo as value
FROM `bono_comprado` b inner join bono b2 on b.id_bono=b2.id WHERE b.activo=1 AND b.id_mascota=".$id_mascota;

$dataBono = Yii::$app->db->createCommand($sql)->queryAll();


/*$dataBono = BonoComprado::find()
  ->select(["id_bono as value","id_bono as id"])
  ->asArray()
   ->all();
*/

$dataBonoMap = ArrayHelper::map($dataBono, 'id', 'value');
?>

<div class="asistencia-form">
  <?php 
  $model->hora = date("H:i:s");
  $model->entrada_salida = 1;
  $model->tipo_asistencia = 1;
  ?>

    <?php $form = ActiveForm::begin([
       'options' => [
        'id' => 'asistencia-form'
     ]
    ]); ?>

     <?php
      echo $form->field($model, 'fecha')->widget(\yii\jui\DatePicker::className(), [
          'language' => 'es',
          'dateFormat' => 'dd-MM-yyyy',
          'value' =>'2020-10-03',
          'clientOptions'=>[
            'defaultDate' => '10-03-2020'
          ],
  ])->textInput(['placeholder' => date("d-m-yy"),'value'=> date("d-m-yy")]);
   ?>
  <?= $form->field($model, 'id_mascota')->hiddenInput(['value'=>$id_mascota])->label(false); ?>
  <?= $form->field($model, 'hora')->textInput() ?>
  
  <?= $form->field($model, 'entrada_salida')->radioList(array('1'=>'Entrada','2' => 'Salida'),array('separator'=>'<br>')) ?>

    <?= $form->field($model, 'tipo_asistencia')->radioList(array('1'=>'Mañana','2' => 'Tarde', '3'=> 'Día Completo', '4'=>'Por Horas'),array('separator'=>'<br>')) ?>


    <?= $form->field($model, 'id_bono_comprado')->dropDownList($dataBonoMap,
      [
        'prompt'=>'Selecione el tipo de Bono',
        'onchange'=>''    
    ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Aceptar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php
    ActiveForm::end(); 
    ?>

</div>
