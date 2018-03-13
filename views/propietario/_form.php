<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\AutoComplete;

use app\models\Propietario;
use app\models\Veterinario;
use app\models\SociedadProtectora;
use app\models\Temperamento;
use app\models\Raza;
use yii\web\JsExpression;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\Propietario */
/* @var $form yii\widgets\ActiveForm */



$this->registerJs( <<< EOT_JS
    

$(document).on('keypress', 'input', function(e) {

 if(((e.keyCode == 13) || (e.keyCode == 3 )) && e.target.type !== 'submit') {
    //window.alert("hola");
    e.preventDefault();
    //return $(e.target).blur().focus();
   var inputs = $(this).closest('form').find(':input:visible');
            inputs.eq( inputs.index(this)+ 1 ).focus();
  }

});


EOT_JS
);

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

//$type_list= Referencia::model()->findAll();
$type_list= ArrayHelper::map($listReferencia,'id','tipo');

$type_temperamento_list = ArrayHelper::map(Temperamento::find()->all(),'id','descripcion');

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

<div class="row">
    <div class="col-sm-12">
        <div class="box box-solid box-info" data-widget="box-widget">
            <div class="box-header">
                <h3 class="box-title">Datos Propietario</h3>
            </div>
            <div class="box-body">
                <!--form propietario -->
                <div class="propietario-form">
                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'dni')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'telefono')->textInput() ?>
                    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'cod_postal')->textInput() ?>
                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'persona_contacto')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'id_referencia')->radioList($type_list) ?>    
                </div>
                <!--fin form propietario-->    
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-12">
        <div class="box box-solid box-info" data-widget="box-widget">
            <div class="box-header"><h3 class="box-title">Datos Mascota</h3></div>
            <div class="box-body">
                <!--form mascota-->
                <div class="mascota-form">
                    <?= $form->field($modelMascota, 'nombre')->textInput(['maxlength' => true]) ?>
                     <?= $form->field($modelMascota, 'fecha_nac')->widget(\yii\jui\DatePicker::className(), ['language' => 'es','dateFormat' => 'dd-MM-yyyy',]) ?>

                    <?= $form->field($modelMascota, 'chip')->textInput() ?>
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
                    <?= Html::activeHiddenInput($modelMascota, 'id_raza') ?>
                    <?= $form->field($modelMascota, 'sexo')->radioList(array('m'=>'Macho','h' => 'Hembra')) ?>
                    <?= $form->field($modelMascota, 'esterilizado')->checkbox() ?>
                     <?= $form->field($modelMascota, 'fecha_ult_celo')->widget(\yii\jui\DatePicker::className(), ['language' => 'es','dateFormat' => 'dd-MM-yyyy',]) ?>
                    <?= $form->field($modelMascota, 'adoptado' )->checkbox( array( 'onChange' => 'javascript:toggleInput(this)' )) ?>
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

                    ?></div>
                    <?= Html::activeHiddenInput($modelMascota, 'id_protectora') ?>
                    <?php echo "<b>Veterinario</b><br>";?>
                    <?php
                      echo AutoComplete::widget([
                          'name' => 'veterinario',
                        'options' => ['placeholder' => 'Seleccione el veterinario ...'],
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
                    <?= Html::activeHiddenInput($modelMascota, 'id_veterinario') ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="box box-solid box-info" data-widget="box-widget">
            <div class="box-header"><h3 class="box-title">Historia Médica</h3></div>
            <div class="box-body">
                <!--form historial meedico -->
                <div class="historial-medico-form">
                <?= $form->field($modelHistMedico, 'enf_cardiaca')->textInput(['maxlength' => true]) ?>
                <?= $form->field($modelHistMedico, 'ale_cutanea')->textInput(['maxlength' => true]) ?>
                <?= $form->field($modelHistMedico, 'ale_alimentaria')->textInput(['maxlength' => true]) ?>
                <?= $form->field($modelHistMedico, 'otras_limit')->textInput(['maxlength' => true]) ?>
                <?= $form->field($modelHistMedico, 'cancer')->textInput(['maxlength' => true]) ?>
                <?= $form->field($modelHistMedico, 'enf_endocrina')->textInput(['maxlength' => true]) ?>
                <?= $form->field($modelHistMedico, 'otras')->textInput(['maxlength' => true]) ?>
                </div>
                <!--fin form historial medico-->    
            </div>
        </div>
    </div>
</div>
 

<div class="row">
    <div class="col-sm-12">
        <div class="box box-solid box-info" data-widget="box-widget">
            <div class="box-header"><h3 class="box-title">Historia de Comportamiento</h3></div>
            <div class="box-body">
                <!--form historial comportamiento-->
                <div class="historial-comportamiento-form">
                    <?= $form->field($modelHistComp, 'ha_mordido')->textInput() ?>
                    <?= $form->field($modelHistComp, 'ha_sido_mordido')->textInput() ?>
                    <?= $form->field($modelHistComp, 'miedo_perro')->textInput() ?>
                    <?= $form->field($modelHistComp, 'miedos')->textInput() ?>
                    <?= $form->field($modelHistComp, 'protege_cosas')->textInput() ?>
                    <?= $form->field($modelHistComp, 'gusta_jugar')->textInput() ?>
                    <?= $form->field($modelHistComp, 'id_temperamento')->radioList($type_temperamento_list) ?>
                    <p><b>¿Cómo actúa frente a las siguientes experiencias?</b></p>
                    <?= $form->field($modelHistComp, 'encuentro_perro')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($modelHistComp, 'persona_desconocida')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($modelHistComp, 'juega_perros')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($modelHistComp, 'juega_personas')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($modelHistComp, 'otra_info')->textInput(['maxlength' => true]) ?>
                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
                <!--fin form historial comportamiento-->    
            </div>
        </div>
    </div>
</div>
