<?php

use yii\helpers\Html;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\Mascota;
use app\models\Bono;
use yii\web\View;


$this->registerJs( <<< EOT_JS
     function updatePriceAbs(descuento)
     {
        precioInicial = parseFloat(descuento);
        precioInicial = -precioInicial + parseFloat($( "#precio" ).val());
        $( "#bonocomprado-precio_final" ).val(precioInicial)
        //window.alert(precioInicial);
     }

     function updatePricePct(descuento)
     {
        precio = (1-(parseFloat(descuento)/100))*parseFloat($( "#precio" ).val());
        precio = precio - parseFloat($( "#bonocomprado-descuento_especial_abs" ).val());
        $( "#bonocomprado-precio_final" ).val(precio);
        window.alert(precio);
     }

    /*  $('#bonocomprado-id_bono').on('change', function(){

        //do your trick
        window.alert('carga');

      });*/
EOT_JS
);



$dataBono = Bono::find()
  ->select(["tipo as value","id as id"])
  ->asArray()
   ->all();

$dataBonoMap = ArrayHelper::map($dataBono, 'id', 'value');

  //$dataMascota = Mascota::find($model->id_mascota);

   
//$this->registerJs($ajaxCall, View::POS_READY);

/* @var $this yii\web\View */
/* @var $model app\models\BonoComprado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bono-comprado-form">
<?php 
  //$model->fecha_compra = date("H:i:s");
  //$model->entrada_salida = 1;
  //$model->tipo_asistencia = 1;
  //$model->id_mascota=$id_mascota;
  ?>

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'id_mascota')->hiddenInput(['value'=>$id_mascota])->label(false); ?>

    <?= $form->field($model, 'id_bono')->dropDownList($dataBonoMap,
      [
        'prompt'=>'Selecione el tipo de Bono',
        'onchange'=>'
            $.get( "'.Url::toRoute('/bono/verdetalle').'", { id: $(this).val() } )
                .done(function( data ) {
                  
                    $( "#precio" ).val(data);
                    $( "#bonocomprado-precio_final" ).val(data);
                }
            );
        '    
    ]
    ) ?>

<?= Html::input('text','precio','', $options=['id'=>'precio','class'=>'form-control','maxlength'=>10, 'style'=>'width:350px']) ?>

    <?php
      echo $form->field($model, 'fecha_compra')->widget(\yii\jui\DatePicker::className(), [
          'language' => 'es',
          'dateFormat' => 'dd-MM-yyyy',
          'value' =>'2020-10-03',
  ])->textInput(['placeholder' => date("d-m-yy"),'value'=> date("d-m-yy")]);
   ?>
    <?= $form->field($model, 'descuento_especial_abs')->textInput(["value"=>0,
                              'onchange'=>'updatePriceAbs(this.value)'    
                          ]) ?>
    <?= $form->field($model, 'descuento_especial_pct')->textInput(["value"=>0,
                              'onchange'=>'updatePricePct(this.value)'
                              ]) ?>
    <?= $form->field($model, 'nota_descuento')->textInput() ?>
    <?= $form->field($model, 'precio_final')->textInput() ?>    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
