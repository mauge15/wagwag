<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Raza;
use app\models\Bono;
use app\models\SociedadProtectora;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\web\JsExpression;
use app\models\Veterinario;
use app\models\VacunaMascota;
use app\models\Anotacion;
use app\models\Vacuna;
use app\models\Mascota;
use app\models\Propietario;
use yii\helpers\Url;
use yii\jui\Dialog;
use yii\web\View;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\Temperamento;
use yii\widgets\Pjax;

$listTemperamento = Temperamento::find()->all();
$temperamento_list= ArrayHelper::map($listTemperamento,'id','descripcion');


$listVacuna = Vacuna::find()->all();
$vacuna_list= ArrayHelper::map($listVacuna,'id','nombre');


/* @var $this yii\web\View */
/* @var $model app\models\Mascota */

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

$ajaxForm = <<<JS
//$(document).pjax('a', '#pjax-container');

    $(".ajax-form").submit(function(event) {
            event.preventDefault(); // stopping submitting
            event.stopImmediatePropagation();
           var data = $(this).serializeArray();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: data
            })
            .done(function(response) {
                if (response.data.success == true) {
                    alert(response.data.message);
                    //alert(response.data.objeto);
                    if (response.data.objeto=="anotacion")
                    {
                    $.pjax.reload('#gridViewAnotacion', "");
                    }
                    else{
                    $.pjax.reload('#gridViewVacuna', "");
                    }
                }
            })
            .fail(function() {
                console.log("error");
            });
        
        //window.alert("prueba ajax");
        });
JS;

$this->registerJs($ajaxForm, View::POS_READY);

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

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Mascotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$actionHistMedico = 'view';
$actionHistComp ='view';
if(is_null($model->id_historial_medico))
{
    $actionHistMedico = 'create';
}
if (is_null($model->id_historial_comportamiento))
{
    $actionHistComp = 'create';
}
if ($model->adoptado==1)
{
  $sociedadProtectora = SociedadProtectora::findOne($model->id_protectora);
  if (isset($sociedadProtectora))
  {
    $nombreProtectora = $sociedadProtectora->nombre;
  }
  else{
    $nombreProtectora = "-";
  }
}
$raza = '';
if (isset($model->id_raza))
             {
              $raza_clase = Raza::findOne($model->id_raza);
              $raza = $raza_clase->nombre;
             }

?>

<div class="row"> <!-- Row 1 -->
    <div class='col-sm-7'> <!--Columna 1 de Row 1 -->
        
        <!--INICIO WIDGET MASCOTA-->
          <div class="box box-solid box-primary" data-widget="box-widget"> <!--BOX Widget-->
              <div class="box-header">
                  <h3 class="box-title">Datos Principales Mascota</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                  </div>
              </div>
              <div class="box-body"> <!--BOX BODY-->
                  <div class="">  <!--form mascota-->
                        ID CONTRATO (MASCOTA): <?=$model->id?><br>
                        ID CONTRATO (PROPIETARIO): <?=$propietarioModel->id?>
                        <?php $form = ActiveForm::begin([ 
                                            'action' => ['mascota/update'], 
                                            'options' => [
                                              'class' => 'ajax-form' ]
                                            ]); ?>
                        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true,'style'=>'width:300px']) ?>
                        <?= $form->field($model, 'fecha_nac')->widget(\yii\jui\DatePicker::className(), [
                              'language' => 'es',
                              'dateFormat' => 'dd-MM-yyyy',
                            ]) ?>
                        <?= $form->field($model, 'chip')->textInput(['style'=>'width:300px']) ?>
                        <?php echo "<b>Raza</b><br>";?>
                        <?php
                          echo AutoComplete::widget([
                              'name' => 'raza',
                              'value' => $raza,
                              'options' => ['placeholder' => 'Seleccione la raza ...'],
                              'clientOptions' => [
                                  'source' => $dataRaza,
                                  'autofill' => TRUE,
                                  'select' => new JsExpression("function( event, ui ) {
                              $('#mascota-id_raza').val(ui.item.id);}"), ],]);
                          echo "<br><br>";
                        ?>
                        <?= Html::activeHiddenInput($model, 'id_raza') ?>
                        <?= Html::activeHiddenInput($model, 'id') ?>
                        <?= $form->field($model, 'sexo')->radioList(array('m'=>'Macho','h' => 'Hembra')) ?>
                        <?= $form->field($model, 'esterilizado')->checkbox() ?>
                        <?= $form->field($model, 'fecha_ult_celo')->widget(\yii\jui\DatePicker::className(), [
                            'language' => 'es',
                            'dateFormat' => 'dd-MM-yyyy',]) ?>
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
                                  $('#mascota-id_protectora').val(ui.item.id);}"),
                                  ],
                              ]);
                              echo "<br><br>";
                              ?> 
                        </div>
                        <?= Html::hiddenInput('id', $model->id)?>
                        <?= Html::activeHiddenInput($model, 'id_protectora') ?>
                        <div id="hiddenDiv" style="display: <?=isset($model->id_propietario) ? 'none':'block'?>"></div>
                        <div class="form-group">
                            <?= Html::submitButton($model->isNewRecord ? 'Añadir' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                  </div> <!--FIN form mascota-->
                </div> <!--FIN BOX BODY-->
        </div>  <!--FIN BOX Widget-->

            <!--INICIO WIDGET PROPIETARIO-->
          <div class="box box-solid box-primary" data-widget="box-widget"> <!--BOX Widget Propietario-->
              <div class="box-header">
                  <h3 class="box-title">Datos Propietario</h3>
                  <div class="box-tools">
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                  </div>
              </div>
              <div class="box-body"> <!--BOX BODY Propietario-->
                  <div class="">  <!--form Propieatario-->
                          
                    <?php $form = ActiveForm::begin([ 
                                            'action' => ['propietario/update'], 
                                            'options' => [
                                              'class' => 'ajax-form'
                                              ]
                                            ]); ?>
                     <?= $form->field($propietarioModel, 'nombre')->textInput(['maxlength' => true, 'style' => 'text-transform: uppercase']) ?>
                    <?= $form->field($propietarioModel, 'apellido')->textInput(['maxlength' => true, 'style' => 'text-transform: uppercase']) ?>
                    <?= $form->field($propietarioModel, 'dni')->textInput(['maxlength' => true, 'style' => 'text-transform: uppercase']) ?>
                    <?= $form->field($propietarioModel, 'telefono')->textInput() ?>
                    <?= $form->field($propietarioModel, 'direccion')->textInput(['maxlength' => true, 'style' => 'text-transform: uppercase']) ?>
                    <?= $form->field($propietarioModel, 'cod_postal')->textInput() ?>
                    <?= $form->field($propietarioModel, 'email')->textInput(['maxlength' => true, 'style' => 'text-transform: uppercase']) ?>
                    <?= $form->field($propietarioModel, 'persona_contacto')->textInput(['maxlength' => true, 'style' => 'text-transform: uppercase']) ?> 
                    <?= Html::activeHiddenInput($propietarioModel, 'id_referencia') ?>  
                    <?= Html::hiddenInput('id', $propietarioModel->id)?>
                    <div class="form-group">
                        <?= Html::submitButton($propietarioModel->isNewRecord ? 'Crear' : 'Guardar', ['class' => $propietarioModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>


                  </div>
              </div> <!--FIN BOX BODY Propietario-->    
            </div> <!-- FIN BOX Widget Propietario-->               
          </div> <!--FIN Columna 1 de Row 1 -->

<div class="col-sm-5">  <!-- Columna 2 de Row 1 -->

      <!--INICIO WIDGET ASISTENCIA BONOS-->
      <div class="box box-solid box-info" data-widget="box-widget">
          <div class="box-header"> <h3 class="box-title">Asistencia y Bonos</h3> </div>
          <div class="box-body">
              <?php
              echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    //'id_bono',
                    [
                      'class'=>'yii\grid\DataColumn',
                      'label'=>'Tipo',
                      'value'=>function($data){
                          $nomCompleto = "No Asignado";
                          if (isset($data->id_bono))
                          {
                              $prop = Bono::findOne($data->id_bono);
                              $nomCompleto = $prop->tipo;
                          }
                          return $nomCompleto;
                      },
                    ],
                    'fecha_compra',
                    'fecha_caducidad',
                    'dias_bono',
                ],]);?>
          </div> <!--FIN Div Body Asistencia Bonos-->
      </div> <!--Fin WIDGET ASISTENCIA BONOS-->
    
    <!--WIDGET INFORMACION INTERNA-->
        <div class="box box-solid box-info" data-widget="box-widget">
          <div class="box-header"><h3 class="box-title">Información Interna</h3></div>
          <div class="box-body">
            <?php Pjax::begin(['id' => 'gridViewAnotacion']);
            echo GridView::widget([
                  'dataProvider' => $dataProviderAnotacion,
                  //'filterModel' => $searchModel,
                  'columns' => [
                      ['class' => 'yii\grid\SerialColumn'],
                      'fecha',
                      'anotacion'
                  ],
              ]); 
            Pjax::end();?>
             <?php $modelAnotacion = new Anotacion();
             $form = ActiveForm::begin([ 
                                            'action' => ['anotacion/createajax'], 
                                            'options' => [
                                              'class' => 'ajax-form'
                                              ]
                                            ]); ?>
            <?= $form->field($modelAnotacion, 'id_mascota')->hiddenInput(['value'=>$model->id])->label(false); ?>
            <?= $form->field($modelAnotacion, 'anotacion')->textarea(['rows' => 3]) ?>
            <?= $form->field($modelAnotacion, 'fecha')->hiddenInput(['value'=>date("Y-m-d")])->label(false); ?>   
            <div class="form-group">
                <?= Html::submitButton($modelAnotacion->isNewRecord ? 'Añadir' : 'Guardar', ['class' => $histMedicoModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
          </div> <!--FIN DIV Body Información Interna-->
        </div><!--FIN WIDGET INFORMACION INTERNA--> 

           
      <!-- WIDGET Vacuna -->
      <div class="box box-solid box-primary" data-widget="box-widget"> 
        <!-- Box Vacuna -->
        <div class="box-header"><h3 class="box-title">Vacunación</h3>   </div>
        <div class="box-body"> <!-- Box Body Vacuna -->
        <?php Pjax::begin(['id' => 'gridViewVacuna']);   ?>                                
        <?= GridView::widget([
        'dataProvider' => $vacunaDataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id_mascota',
            [
              'class'=>'yii\grid\DataColumn',
              'label'=>'Nombre Vacuna',
              'enableSorting' => TRUE,
              'value'=>function($data){
                  $nomCompleto = "No Asignado";
                  if (isset($data->id_vacuna))
                  {
                      $prop = Vacuna::findOne($data->id_vacuna);
                      $nomCompleto = $prop->nombre;

                  }
                  return $nomCompleto;
              },
          ],
            'fecha',
            'proxima_fecha'
          ],
        ]); ?>
        <?php Pjax::end();?>
        <?php $modelVacuna = new VacunaMascota();
        $formVacuna = ActiveForm::begin([ 
                                      'action' => ['vacunamascota/createajax'], 
                                      'options' => [
                                        'class' => 'ajax-form'
                                        ]
                                      ]); ?>
        <?= $formVacuna->field($modelVacuna, 'id_mascota')->hiddenInput(['value'=>$model->id])->label(false); ?>
        <?= $formVacuna->field($modelVacuna, 'id_vacuna')->dropDownList($vacuna_list, ['prompt' => 'Seleccione Uno' ])->label("Tipo vacuna");    ?>                            
        <?= $formVacuna->field($modelVacuna, 'fecha')->widget(\yii\jui\DatePicker::className(), [
                              'language' => 'es',
                              'dateFormat' => 'dd-MM-yyyy',
                            ]) ?>

        <div class="form-group">
          <?= Html::submitButton($modelVacuna->isNewRecord ? 'Añadir' : 'Guardar', ['class' => $modelVacuna->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
        </div>
        </div> <!-- FIN Box Body Vacuna -->
      </div> <!-- FIN Widget Box Vacuna -->

    </div> <!-- FIN Columna 2 de Row 1 -->                           

<div class="row"> <!-- Inicio Row2 -->
<div class='col-sm-6'> <!-- Columna Historial Medico -->
      <div class="box box-solid box-primary" data-widget="box-widget">
        <div class="box-header"><h3 class="box-title">Historial Médico</h3>   </div>
          <div class="box-body">
              <?php $form = ActiveForm::begin([ 
                                              'action' => ['historialmedico/update'], 
                                              'options' => [
                                                'class' => 'ajax-form'
                                                ]
                                              ]); ?>
              <?= $form->field($histMedicoModel, 'enf_cardiaca')->textInput(['maxlength' => true]) ?>
              <?= $form->field($histMedicoModel, 'ale_alimentaria')->textInput(['maxlength' => true]) ?>
              <?= $form->field($histMedicoModel, 'ale_cutanea')->textInput(['maxlength' => true]) ?>
              <?= $form->field($histMedicoModel, 'otras_limit')->textInput(['maxlength' => true]) ?>
              <?= $form->field($histMedicoModel, 'cancer')->textInput(['maxlength' => true]) ?>
              <?= $form->field($histMedicoModel, 'enf_endocrina')->textInput(['maxlength' => true]) ?>
              <?= $form->field($histMedicoModel, 'otras')->textInput(['maxlength' => true]) ?>
              <?= Html::hiddenInput('id', $histMedicoModel->id)?>


              <div class="form-group">
                  <?= Html::submitButton($histMedicoModel->isNewRecord ? 'Crear' : 'Guardar', ['class' => $histMedicoModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
              </div>
              <?php ActiveForm::end(); ?>
        </div> <!--FIN Box Body Historial Medico-->
      </div> <!--FIN WIDGET Body Historial Medico-->
      </div> <!--FIN Columna Hist Medico-->

    <div class='col-sm-6'> <!-- Columna Historial Comportamiento -->
      <div class="box box-solid box-primary" data-widget="box-widget"> <!-- Box Historial Comportamiento -->
        <div class="box-header">
          <h3 class="box-title">Historial Comportamiento</h3>   
        </div>
        <div class="box-body"> <!-- Box Body Historial Comportamiento -->

            <?php $form = ActiveForm::begin([ 
                                            'action' => ['historialcomportamiento/update'], 
                                            'options' => [
                                              'class' => 'ajax-form'
                                              ]
                                            ]); ?>
            <?= $form->field($histComportamientoModel, 'ha_mordido')->textInput() ?>
            <?= $form->field($histComportamientoModel, 'ha_sido_mordido')->textInput() ?>
            <?= $form->field($histComportamientoModel, 'miedo_perro')->textInput() ?>
            <?= $form->field($histComportamientoModel, 'id_temperamento')->radioList($temperamento_list) ?>
            <?= $form->field($histComportamientoModel, 'juega_perros')->textInput(['maxlength' => true]) ?>
            <?= $form->field($histComportamientoModel, 'juega_personas')->textInput(['maxlength' => true]) ?>
            <?= $form->field($histComportamientoModel, 'persona_desconocida')->textInput(['maxlength' => true]) ?>
            <?= $form->field($histComportamientoModel, 'otra_info')->textInput(['maxlength' => true]) ?>
            <?= $form->field($histComportamientoModel, 'encuentro_perro')->textInput(['maxlength' => true]) ?>
            <?= $form->field($histComportamientoModel, 'miedos')->textInput(['maxlength' => true]) ?>
            <?= $form->field($histComportamientoModel, 'protege_cosas')->textInput(['maxlength' => true]) ?>
            <?= $form->field($histComportamientoModel, 'gusta_jugar')->textInput(['maxlength' => true]) ?>
            <?= Html::hiddenInput('id', $histComportamientoModel->id)?>
            <div class="form-group">
                <?= Html::submitButton($histComportamientoModel->isNewRecord ? 'Crear' : 'Guardar', ['class' => $histComportamientoModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>


        </div> <!-- FIN Box Body Historial Comportamiento -->
      </div> <!-- FIN Box Historial Comportamiento -->
    </div> <!-- FIN Columna Historial Comportamiento -->
  </div> <!-- FIN Row 2 -->
