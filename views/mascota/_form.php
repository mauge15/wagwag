<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
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


   $dataProtectora = SociedadProtectora::find()
  ->select(["nombre as value","nombre as label","id as id"])
  ->asArray()
   ->all();
?>

<div class="mascota-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

  

    <?= $form->field($model, 'fecha_nac')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '99/99/9999']) ?>

    <?= $form->field($model, 'chip')->textInput() ?>

    <?php echo "<b>Raza</b><br><br>";?>
  
  <?php
    echo AutoComplete::widget([
        'name' => 'raza',
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
        'clientOptions' => [
            'source' => $dataProtectora,
            'autofill' => TRUE,
            'select' => new JsExpression("function( event, ui ) {
        $('#mascota-id_protectora').val(ui.item.id);
     }"),
        ],
    ]);
    echo "<br><br>";

    ?></div>
    <?= Html::activeHiddenInput($model, 'id_protectora') ?>

    <?php echo "<b>Veterinario</b><br><br>";?>
	
	<?php
	  echo AutoComplete::widget([
	      'name' => 'veterinario',
	      'clientOptions' => [
	          'source' => $data,
            'autofill' => TRUE,
            'select' => new JsExpression("function( event, ui ) {
        $('#mascota-id_veterinario').val(ui.item.id);
     }"),
	      ],
	  ]);
    echo "<br><br>";
	?>
	
	<?= Html::activeHiddenInput($model, 'id_veterinario') ?>
    
    <div class="form-group">
        <?= Html::submitButton('Añadir Historial Médico', ['class' => 'btn btn-primary']) ?>
    </div>

  <div class="form-group">
        <?= Html::submitButton('Añadir Historial de Comportamiento', ['class' => 'btn btn-primary']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Añadir' : 'Editar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
