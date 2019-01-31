<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use yii\jui\DatePicker;
use app\models\Propietario;
use app\models\Veterinario;
use app\models\SociedadProtectora;
use app\models\Raza;  
use yii\web\JsExpression;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\Mascota */
/* @var $form yii\widgets\ActiveForm */

$buttonToggler = <<<JS
    toggleInput=function(src){
      if(src.checked){
        $( "#hiddenDiv" ).show();
       }else{
         $( "#hiddenDiv" ).hide();
       }
    }
JS;
$this->registerJs($buttonToggler, View::POS_READY);


?>
<?php
$data = Veterinario::find()
  ->select(["nombre as value","nombre as label","id as id"])
  ->asArray()
   ->all();


$dataRaza = Raza::find()
  ->select(["nombre as value","nombre as label","id as id"])
  ->asArray()
   ->all();

   $dataPropietario = Propietario::find()
  ->select(["CONCAT(nombre,' ',apellido) as value","CONCAT(nombre,' ',apellido) as label","id as id"])
  ->asArray()
   ->all();



   $dataProtectora = SociedadProtectora::find()
  ->select(["nombre as value","nombre as label","id as id"])
  ->asArray()
   ->all();
?>


<!--form mascota-->
<div class="mascota-form">
  <?php $form = ActiveForm::begin(); ?>
  <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'fecha_nac')->widget(\yii\jui\DatePicker::className(), [
    'language' => 'es',
    'dateFormat' => 'dd-MM-yyyy',
  ]) ?>

  
  <?php /*$form->field($model, 'fecha_nac')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '99/99/9999'])*/ ?>
  <?= $form->field($model, 'chip')->textInput() ?>
  <?php echo "<b>Raza</b><br>";?>
  <?php
    echo AutoComplete::widget([
        'name' => 'raza',
        'options' => ['placeholder' => 'Seleccione la raza ...'],
        'clientOptions' => [
            'source' => $dataRaza,
            'autofill' => TRUE,
            'select' => new JsExpression("function( event, ui ) {
        $('#mascota-id_raza').val(ui.item.id);
     }"),
        ],
    ]);
    echo "<br><br>";
  ?>
  <?= Html::activeHiddenInput($model, 'id_raza') ?>
  <?= $form->field($model, 'sexo')->radioList(array('m'=>'Macho','h' => 'Hembra')) ?>
  <?= $form->field($model, 'esterilizado')->checkbox() ?>
  <?= $form->field($model, 'fecha_ult_celo')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '99/99/9999']) ?>
  <?= $form->field($model, 'adoptado' )->checkbox( array( 'onChange' => 'javascript:toggleInput(this)' )) ?>
  <div id="hiddenDiv" style="display: none">
  <?php 
     echo AutoComplete::widget([
        'name' => 'protectora',
        'options' => ['placeholder' => 'Seleccione la protectora ...', 'class' => 'form-control'],
        'clientOptions' => [
            'source' => $dataProtectora,
            'autofill' => TRUE,
            'select' => new JsExpression("function( event, ui ) {
        $('#mascota-id_protectora').val(ui.item.id);
     }"),
        ],
    ]);
    echo "<br><br>";
  ?> 
  </div>
  <?= Html::activeHiddenInput($model, 'id_protectora') ?>
  <div id="hiddenDiv" style="display: <?=isset($model->id_propietario) ? 'none':'block'?>">
  <?php 
  /*echo "<b>Propietario</b><br>";
    echo AutoComplete::widget([
        'name' => 'propietario',
        'options' => ['placeholder' => 'Seleccione el propietario ...', 'class' => 'form-control'],
        'clientOptions' => [
            'source' => $dataPropietario,
            'autofill' => TRUE,
            'select' => new JsExpression("function( event, ui ) {
        $('#mascota-id_propietario').val(ui.item.id);
     }"),
        ],
    ]);
    echo "<br><br>";
    Html::activeHiddenInput($model, 'id_propietario')*/
  ?>
  </div>
  <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Añadir' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
  </div>

    <?php ActiveForm::end(); ?>

</div>


