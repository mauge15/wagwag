<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Raza;
use app\models\Bono;
use app\models\SociedadProtectora;
use yii\grid\GridView;
use yii\web\JsExpression;
use app\models\Veterinario;
use app\models\Mascota;
use app\models\Propietario;
use yii\helpers\Url;
use yii\jui\Dialog;
use yii\web\View;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use yii\jui\DatePicker;

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
    $(".comment-form").submit(function(event) {
            event.preventDefault(); // stopping submitting
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
                    alert("Wow you commented");
                }
            })
            .fail(function() {
                console.log("error");
            });
        
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
              //echo " por aqui";
              $raza_clase = Raza::findOne($model->id_raza);
              $raza = $raza_clase->nombre;
             }

?>


<div class="row">
    <div class='col-sm-7'>
      <div class="box box-solid box-primary" data-widget="box-widget">
        <div class="box-header">
          <h3 class="box-title">Datos Principales</h3>
          <div class="box-tools">
            <!-- This will cause the box to be removed when clicked -->
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            <!-- This will cause the box to collapse when clicked -->
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
        
        <!--form mascota-->
        <div class="">
          <?php $form = ActiveForm::begin(['id' => 'mascota', 
    'action' => ['mascota/update'], 
    'enableAjaxValidation' => true, 
    'validationUrl' => 'validation-rul', ]); ?>
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
                $('#mascota-id_raza').val(ui.item.id);
            }"),
                ],
            ]);
            echo "<br><br>";
          ?>
          
          <?= Html::activeHiddenInput($model, 'id_raza') ?>
          <?= $form->field($model, 'sexo')->radioList(array('m'=>'Macho','h' => 'Hembra')) ?>
          <?= $form->field($model, 'esterilizado')->checkbox() ?>


          <?php // $form->field($model, 'fecha_ult_celo')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '99/99/9999','options'=>['style'=>'width:200px']]) ?>
          
          <?= $form->field($model, 'fecha_ult_celo')->widget(\yii\jui\DatePicker::className(), [
            'language' => 'es',
            'dateFormat' => 'dd-MM-yyyy',
          ]) ?>



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
        <div id="hiddenDiv" style="display: <?=isset($model->id_propietario) ? 'none':'block'?>"></div>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Añadir' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
      </div>
    </div>
</div>

</div>

<div class="col-sm-5">
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
    <div class="row">
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
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="box box-solid box-info" data-widget="box-widget">
          <div class="box-header">
            <h3 class="box-title">Información Interna</h3>
          </div>
          <div class="box-body">
          

            <?= GridView::widget([
        'dataProvider' => $dataProviderAnotacion,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'fecha',
            'anotacion'
        ],
    ]); ?>


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

              <?= DetailView::widget([
        'model' => $histMedicoModel,
        'attributes' => [
            'id',
            'enf_cardiaca',
            'ale_alimentaria',
            'ale_cutanea',
            'otras_limit',
            'cancer',
            'enf_endocrina',
            'otras',
        ],
    ]) ?>


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

             <?= DetailView::widget([
        'model' => $histComportamientoModel,
        'attributes' => [
            'id',
            'id_mascota',
            'ha_mordido',
            'ha_sido_mordido',
            'miedo_perro',
            'id_temperamento',
            'juega_perros',
            'juega_personas',
            'persona_desconocida',
            'otra_info',
        ],
    ]) ?>


        </div>
      </div>
    </div>
  </div>