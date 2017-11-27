<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Raza;
use app\models\Bono;
use app\models\SociedadProtectora;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Mascota */

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
   

<div class="mascota-view">

 <p>
        <?php // Html::a('Ver bonos', ['bonocomprado/bonomascota', 'id_mascota' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
   

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombre',
            ['label'=>'Fecha de Nacimiento',
            'value'=>date_format(date_create($model->fecha_nac),'d-m-Y')],
            'chip',
            ['label'=>'Raza',
            'value'=>Raza::findOne($model->id_raza)->nombre],
            ['label'=>'Sexo',
            'value'=> ($model->sexo=="m") ? 'Macho' : 'Hembra'],
            ['label'=>'Esterilizado',
            'value'=>($model->esterilizado==1) ? 'Si' : 'No'],
            ['label'=>'Fecha de Ultimo Celo',
            'value'=>date_format(date_create($model->fecha_ult_celo),'d-m-Y')],
            ['label'=>'Adoptado',
            'value'=>($model->adoptado==1) ? 'Si':'No'],
            ['label'=>'Protectora',
            'value'=> ($model->adoptado==1)? SociedadProtectora::findOne($model->id_protectora)->nombre : '-'],
        ],
    ]) ?>

     <p>
        <?= Html::a(($actionHistMedico=='create') ? 'Añadir Historial Medico' : 'Ver Historial Médico', 
        [($actionHistMedico=='create') ? 'historial' : 'historialmedico/view2', 'id' => $model->id_historial_medico,'id_historial_medico' => $model->id_historial_medico,'id_mascota'=> $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(is_null($model->id_historial_comportamiento) ? 'Añadir Historial de Comportamiento':'Ver Historial de Comportamiento', [is_null($model->id_historial_comportamiento) ? 'historialcomportamiento' : 'historialcomportamiento/view2', 'id' => $model->id_historial_comportamiento,'id_historial_comportamiento' => $model->id_historial_comportamiento, 'id_mascota' => $model->id ], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>




  </div>
</div>

</div>

<div class="col-sm-5">

<div class="box box-solid box-info" data-widget="box-widget">
  <div class="box-header">
    <h3 class="box-title">Asistencia y Bonos</h3>
    <div class="box-tools">
      <!-- This will cause the box to be removed when clicked -->
      <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
      <!-- This will cause the box to collapse when clicked -->
      <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
    </div>
  </div>
   <div class="box-body">
    


 <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
              [
                'class'=>'yii\grid\DataColumn',
                'label'=>'Bono',
                'enableSorting' => TRUE,
                'value'=>function($data){
                    $bono = Bono::findOne($data->id_bono);
                    return $bono->tipo;
                },
            ],
            'fecha_caducidad',
            [
                'class'=>'yii\grid\DataColumn',
                'label'=>'Dias',
                'value'=>function($data){return $data->dias_bono;},
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


  </div>
</div>
</div>
