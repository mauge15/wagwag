<?php

/* @var $this yii\web\View */
use yii\grid\GridView;
use app\models\Raza;
use app\models\Propietario;
use app\models\Mascota;
use yii\web\JsExpression;
use yii\helpers\Html;
use yii\jui\Dialog;
use yii\web\View;

//$this->title = 'Wagwag App';
/*Dialog::begin([
    'clientOptions' => [
        'modal' => true,
        'title' => 'Tipo de asistencia',
        'class'=>'btn btn-sm btn-danger', 
                'click'=>new \yii\web\JsExpression(' function() { $( this ).dialog( "close" ); }')
        
    ],
]);

echo 'Dialog contents here...';

Dialog::end();*/

$this->registerJs(
    "$('#myModal').modal();",
    View::POS_READY,
    'my-button-handler'
);

?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<div class="site-index">

    

    <div class="body-content">

        <div class="row">
            

            <div class="col-sm-12">
                <div class="box box-solid box-info" data-widget="box-widget">
                    <div class="box-header">
                        <h3 class="box-title">Lista Mascotas</h3>
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
                            'header'=> 'Acciones',
                            'controller' => 'mascota'],

                            ['class' => 'yii\grid\ActionColumn',
                            'template' => '{asistencia}',
                            'header' => 'Asistencia',
                            'buttons' => [
                                'asistencia' => function($url, $model)
                                {
                                    return Html::a('<span class="glyphicon glyphicon-ok"></span>', ['delete', 'id' => $model->id], [
                                        'class' => '',
                                        'data' => [
                                            'confirm' => 'Are you absolutely sure ? You will lose all the information about this user with this action.',
                                            'method' => 'post',
                                        ],
                                        ]);
                                }
                            ]
                            ],

                             [
                                'class'=>'yii\grid\DataColumn',
                                'label'=>'Dias',
                                'value'=>function($data){
                                    return 2;
                                },
                            ],
                        ],
                        ]); ?>   
                    </div>
                </div>
            </div>

            <!--<div class='col-sm-3'>
                <div class="box box-solid box-primary" data-widget="box-widget">
                    <div class="box-header">
                        <h3 class="box-title">Otro</h3>
                        <div class="box-tools">
                             
                              <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                             
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
        -->
        </div>

         <div class="row">
            

            <div class="col-sm-12">
                <div class="box box-solid box-info" data-widget="box-widget">
                    <div class="box-header">
                        <h3 class="box-title">Guardería Hoy</h3>
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
                            'header'=> 'Acciones',
                            'controller' => 'mascota'],

                            ['class' => 'yii\grid\ActionColumn',
                            'template' => '{update} {delete}',
                            'header' => 'Asistencia',
                            'buttons' => [
                                'delete' => function($url, $model)
                                {
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], [
                                        'class' => '',
                                        'data' => [
                                            'confirm' => 'Are you absolutely sure ? You will lose all the information about this user with this action.',
                                            'method' => 'post',
                                        ],
                                        ]);
                                }
                            ]
                            ],

                             [
                                'class'=>'yii\grid\DataColumn',
                                'label'=>'Dias',
                                'value'=>function($data){
                                    return 2;
                                },
                            ],
                        ],
                        ]); ?>   
                    </div>
                </div>
            </div>

            <!--<div class='col-sm-3'>
                <div class="box box-solid box-primary" data-widget="box-widget">
                    <div class="box-header">
                        <h3 class="box-title">Otro</h3>
                        <div class="box-tools">
                             
                              <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                             
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
        -->
        </div>
