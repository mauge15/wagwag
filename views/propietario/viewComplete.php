<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use app\models\Referencia;
use app\models\Raza;
use app\models\Vacuna;
use app\models\Temperamento;
use kartik\detail\DetailView;
use yii\widgets\Pjax;
use app\models\VacunaMascota;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
$listVacuna = Vacuna::find()->all();
use yii\web\View;
$vacuna_list= ArrayHelper::map($listVacuna,'id','nombre');

/* @var $this yii\web\View */
/* @var $model app\models\Propietario */

$this->title = "Datos guardados";
$this->params['breadcrumbs'][] = ['label' => 'Propietarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $modelPropietario->nombre." ".$modelPropietario->apellido;

$ajaxForm = <<<JS
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
                    $.pjax.reload('#gridViewVacuna', "");
                }
            })
            .fail(function() {
                console.log("error");
            }); 
        //window.alert("prueba ajax");
        });
JS;

$this->registerJs($ajaxForm, View::POS_READY);

?>

<div class="propietario-view">

<div class="row">
<div class="col-sm-12">
    <div class="box box-solid box-info" data-widget="box-widget">
            <div class="box-header"><h3 class="box-title">Datos Propietario</h3></div>
            <div class="box-body">
                <p>Nº Contrato (mascota): <?= $modelMascota->id ?></p>
                <p>Nº Contrato (propietario): <?= $modelPropietario->id ?></p>
                <?= DetailView::widget([
                    'model' => $modelPropietario,
                    'condensed' => true,
                    'bordered' => true,
                    'attributes' => [
                        [
                            'columns' => [
                                [
                                    'attribute'=>'nombre', 
                                    'label'=>'Nombre: ',
                                    'valueColOptions'=>['style'=>'width:30%']
                                ],
                                [
                                    'attribute'=>'apellido',
                                    'label' => 'Apellido: ', 
                                    'valueColOptions'=>['style'=>'width:30%']
                                ],
                            ],
                        ],
                        [
                            'columns' => [
                                [
                                    'attribute'=>'dni', 
                                    'label'=>'DNI: ',
                                    'valueColOptions'=>['style'=>'width:30%']
                                ],
                                [
                                    'attribute'=>'telefono',
                                    'label' => 'Teléfono: ', 
                                    'valueColOptions'=>['style'=>'width:30%']
                                ],
                            ],
                        ],

                        [
                            'columns' => [
                                [
                                    'attribute'=>'direccion', 
                                    'label'=>'Dirección: ',
                                    'valueColOptions'=>['style'=>'width:30%']
                                ],
                                [
                                    'attribute'=>'cod_postal',
                                    'label' => 'Cód. Postal: ', 
                                    'valueColOptions'=>['style'=>'width:30%']
                                ],
                            ],
                        ],
                        'email:email',
                        [
                            'columns' => [
                                [
                                    'attribute'=>'persona_contacto', 
                                    'label'=>'Persona de Contacto: ',
                                    'valueColOptions'=>['style'=>'width:30%']
                                ],
                                [
                                    'label' => 'Como nos conoció?: ', 
                                    'value'=> Referencia::findOne($modelPropietario->id_referencia)->tipo,
                                    'valueColOptions'=>['style'=>'width:30%']
                                ],
                            ],
                        ],
                    ],
                ],$options = ['style' => 'height:10px']) ?>
                </div>
                </div>
                </div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="box box-solid box-info" data-widget="box-widget">
            <div class="box-header"><h3 class="box-title">Datos Mascota</h3></div>
            <div class="box-body">
    <?= DetailView::widget([
        'model' => $modelMascota,
        'condensed' => true,
        'attributes' => [
            'nombre' ,
            'fecha_nac' ,
            'chip',
            ['label'=>'Raza',
            'value' => Raza::findOne($modelMascota->id_raza)->nombre],
            'sexo',
            'esterilizado',
            'fecha_ult_celo',
            'adoptado' ,
            /*'id_protectora' => 'Asociación Protectora',
            'id_veterinario' => 'Veterinario',
            'id_historial_medico' => 'Id Historial Medico',
            'id_historial_comportamiento' => 'Id Historial Comportamiento',*/
        ],
    ]) ?>
    </div>
    </div>
    </div>
</div>
<div class="row">
<div class="col-sm-6">
<div class="box box-solid box-info" data-widget="box-widget">
            <div class="box-header"><h3 class="box-title">Historial Comportamiento</h3></div>
            <div class="box-body">
      <?= DetailView::widget([
        'model' => $modelHistComp,
        'condensed' => true,
        'attributes' => [
            'ha_mordido' ,
            'ha_sido_mordido' ,
            'miedo_perro' ,
            ['label'=>'Temperamento',
            'value' => (Temperamento::findOne($modelHistComp->id_temperamento))->descripcion],
            'juega_perros',
            'juega_personas' ,
            'persona_desconocida' ,
            'encuentro_perro' ,
            'miedos' ,
            'protege_cosas' ,
            'gusta_jugar' ,
            'otra_info' ,
        ],
    ]) ?>
    </div>
    </div>
</div>
<div class="col-sm-6">
<div class="box box-solid box-info" data-widget="box-widget">
            <div class="box-header"><h3 class="box-title">Historial Médico</h3></div>
            <div class="box-body">
     <?= DetailView::widget([
        'model' => $modelHistMedico,
        'condensed' => true,
        'attributes' => [
            'enf_cardiaca' ,
            'ale_alimentaria' ,
             'ale_cutanea' ,
            'otras_limit' ,
            'cancer' ,
            'enf_endocrina',
            'otras' ,
        ],
    ]) ?>
    </div>
    </div>
</div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="box box-solid box-info" data-widget="box-widget">
            <div class="box-header"><h3 class="box-title">Vacunas</h3></div>
            <div class="box-body">
                <!--form nueva vacuna-->
                <div class="vacuna-form">
                <?php Pjax::begin(['id' => 'gridViewVacuna']);   ?>                                
                    <?= GridView::widget([
                    'dataProvider' => $vacunaDataProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'id_mascota',
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
                    <?= $formVacuna->field($modelVacuna, 'id_mascota')->hiddenInput(['value'=>$modelMascota->id])->label(false); ?>
                    <?= $formVacuna->field($modelVacuna, 'id_vacuna')->dropDownList($vacuna_list, ['prompt' => 'Seleccione Uno' ])->label("Tipo vacuna");    ?>                            
                    <?= $formVacuna->field($modelVacuna, 'fecha')->widget(\yii\jui\DatePicker::className(), [
                                        'language' => 'es',
                                        'dateFormat' => 'dd-MM-yyyy',
                                        ]) ?>

                    <div class="form-group">
                    <?= Html::submitButton($modelVacuna->isNewRecord ? 'Añadir' : 'Guardar', ['class' => $modelVacuna->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                <!--fin form nueva vacuna-->    
            </div>
        </div>
    </div>

</div>
