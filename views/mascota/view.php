<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Raza;
use app\models\Bono;
use app\models\SociedadProtectora;
use yii\grid\GridView;
use yii\web\JsExpression;
use app\models\Veterinario;
use app\models\Anotacion;
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
                    $.pjax.reload('#gridViewAnotation', "");
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
            </div> <!-- FIN BOX Widget Propieatario-->               
                        



          </div> <!--FIN Columna 1 de Row 1 -->

<div class="col-sm-5">  <!-- Columna 2 de Row 1 -->
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-solid box-info" data-widget="box-widget">
        <div class="box-header">
          <h3 class="box-title">Asistencia y Bonos</h3>
        </div>
        <div class="box-body">
          <?php
             if (isset($bonoCompradoModel))
             {
              //echo " por aqui";
              $bono = Bono::findOne($bonoCompradoModel->id_bono);
              echo DetailView::widget([
              'model' => $bonoCompradoModel,
              'attributes' => [
                  ['label'=>'Tipo',
                  'value'=>$bono->tipo],
                  ['label'=>'Fecha de Caducidad',
                  'value'=>date_format(date_create($bonoCompradoModel->fecha_caducidad),'d-m-Y')],
                  ['label'=>'Días Utilizados',
                  'value'=>$bonoCompradoModel->dias_utilizados],
                  ['label'=>'Días Restantes',
                  'value'=> $bonoCompradoModel->dias_bono],
              ],
              ]) ;
            }
          else
          {
            echo "No tiene bonos activos";
          }?>
        </div>
      </div>
    </div>
  </div>
    <!--<div class="row">
      <div class="col-sm-12">
        <div class="box box-solid box-info" data-widget="box-widget">
          <div class="box-header">
            <h3 class="box-title">Información Propietario</h3>
          </div>
          <div class="box-body">
            Probelmas de copmortamiento con personas desconocidas. Muerde a otros perros cuando esta comiendo
          </div>
        </div>
      </div>
    </div>-->

    <div class="row">
      <div class="col-sm-12">
        <div class="box box-solid box-info" data-widget="box-widget">
          <div class="box-header">
            <h3 class="box-title">Información Interna</h3>
          </div>
          <div class="box-body">
          
            <?php Pjax::begin(['id' => 'gridViewAnotation']);
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
                                            'action' => ['anotacion/create-ajax'], 
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

          </div>
        </div>
      </div>
    </div>


</div>
</div>
<div class="row">
    <div class='col-sm-12'>
      <div class="box box-solid box-primary" data-widget="box-widget">
        <div class="box-header">
          <h3 class="box-title">Historial Médico</h3>   
        </div>
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


        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class='col-sm-12'>
      <div class="box box-solid box-primary" data-widget="box-widget">
        <div class="box-header">
          <h3 class="box-title">Historial Comportamiento</h3>   
        </div>
        <div class="box-body">

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


        </div>
      </div>
    </div>
  </div>