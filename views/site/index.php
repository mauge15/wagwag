<?php

/* @var $this yii\web\View */
use yii\grid\GridView;
use app\models\Raza;
use app\models\Propietario;
use app\models\Mascota;

//$this->title = 'Wagwag App';
?>
<div class="site-index">

    

    <div class="body-content">

        <div class="row">
            

            <div class="col-sm-9">
                <div class="box box-solid box-info" data-widget="box-widget">
                    <div class="box-header">
                        <h3 class="box-title">Mascotas</h3>
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
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            //'id',
                            'nombre',
                            //'fecha_nac',
                            [
                                'class'=>'yii\grid\DataColumn',
                                'label'=>'Propietario',
                                'enableSorting' => TRUE,
                                'value'=>function($data){
                                    $nomCompleto = "No Asignado";
                                    if (isset($data->id_propietario))
                                    {
                                        $prop = Propietario::findOne($data->id_propietario);
                                        $nomCompleto = $prop->nombre." ".$prop->apellido;

                                    }
                                    return $nomCompleto;
                                },
                            ],

                            [
                                'class'=>'yii\grid\DataColumn',
                                'label'=>'Raza',
                                'value'=>function($data){
                                    return Raza::findOne($data->id_raza)->nombre;
                                },
                            ],
                            // 'sexo',
                            // 'esterilizado',
                            // 'fecha_ult_celo',
                            // 'adoptado',
                            // 'id_protectora',
                            // 'id_historial_medico',
                            // 'id_historial_comportamiento',

                            ['class' => 'yii\grid\ActionColumn',
                            'controller' => 'mascota'],
                        ],
                        ]); ?>   
                    </div>
                </div>
            </div>

            <div class='col-sm-3'>
                <div class="box box-solid box-primary" data-widget="box-widget">
                    <div class="box-header">
                        <h3 class="box-title">Otro</h3>
                        <div class="box-tools">
                              <!-- This will cause the box to be removed when clicked -->
                              <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                              <!-- This will cause the box to collapse when clicked -->
                              <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="mascota-view">
                            aqui 
                        </div>
                    </div>
                </div>
            </div>
        </div>
