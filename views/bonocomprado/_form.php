<?php

use yii\helpers\Html;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Mascota;
use app\models\Bono;
use yii\web\View;




$dataBono = Bono::find()
  ->select(["tipo as value","id as id"])
  ->asArray()
   ->all();

$dataBonoMap = ArrayHelper::map($dataBono, 'id', 'value');

  $dataMascota = Mascota::find()
  ->select(["nombre as value","nombre as label","id as id"])
  ->asArray()
   ->all();

  
$this->registerJs( <<< EOT_JS
     
     // using GET method
//$.get({
  //url: 'url',
  //data: {},
  //success: function(){},
//});



EOT_JS
);


   
//$this->registerJs($ajaxCall, View::POS_READY);

/* @var $this yii\web\View */
/* @var $model app\models\BonoComprado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bono-comprado-form">

    <?php $form = ActiveForm::begin(); ?>

     <?php echo "<b>Mascota</b><br>";?>
    
    <?php
      echo AutoComplete::widget([
          'name' => 'mascota',
        'options' => ['placeholder' => 'Seleccione la mascota ...'],
          'clientOptions' => [
              'source' => $dataMascota,
            'autofill' => TRUE,
            'select' => new JsExpression("function( event, ui ) {
        $('#bonocomprado-id_mascota').val(ui.item.id);
     }"),
          ],
      ]);
    echo "<br><br>";
    ?>
    
    <?= Html::activeHiddenInput($model, 'id_mascota') ?>

    <?= $form->field($model, 'id_bono')->dropDownList($dataBonoMap) ?>

    <?= $form->field($model, 'fecha_compra')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '99/99/9999']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
