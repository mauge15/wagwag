<?php

/* @var $this yii\web\View */
use yii\grid\GridView;
use app\models\Raza;
use app\models\Bono;
use app\models\Propietario;
use app\models\BonoComprado;
use app\models\Mascota;
use yii\web\JsExpression;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\Dialog;
use yii\web\View;
use yii\bootstrap\Modal;

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

/*$this->registerJs(
    "$('#myModal').modal();",
    View::POS_READY,
    'my-button-handler'
);*/


 $this->registerJs(
    "$(document).on('click', '.showModalButton', function(){
        if ($('#modal').data('bs.modal').isShown) {
            $('#modal').find('#modalContent')
                    .load($(this).attr('value'));
            //dynamiclly set the header for the modal via title tag
            document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        } else {
            //if modal isn't open; open it and load content
            $('#modal').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'));
             //dynamiclly set the header for the modal via title tag
            document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        }
    });");

    $ajaxForm = <<<JS
    $("#boton_prueba").click(function(){ window.alert('hola'); });
JS;

$this->registerJs($ajaxForm, View::POS_READY);

yii\bootstrap\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'modal',
    'size' => 'modal-lg',
    'closeButton' => ['id' => 'close-button'],  
    //keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
    'clientOptions' => ['keyboard' => TRUE]
]);
echo "<div id='modalContent'></div>";
yii\bootstrap\Modal::end();

$this->registerJs(
"$('#calendar').fullCalendar({
     weekends: false // will hide Saturdays and Sundays
})",
View::POS_READY);
/*
Yii::$app->mailer->compose()
    ->setFrom('me.rojas.vera@gmail.com')
    ->setTo('mauge15@msn.com')
    ->setSubject('Mensajr')
    ->setTextBody('Plain text content')
    ->setHtmlBody('<b>HTML content</b>')
    ->send();*/
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

 
        <!--<div id='calendar'></div>-->

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

                        <?php
                        //Html::button('Detalles', ['value' => Url::to(['asistencia/create']), 'title' => 'Fichaje', 'class' => 'showModalButton loadMainContent btn btn-success']); 
                        ?>


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

                            /*['class' => 'yii\grid\ActionColumn',
                            'header'=> 'Acciones',
                            'controller' => 'mascota'
                        ],*/

                           /* ['class' => 'yii\grid\ActionColumn',
                            'template' => '{asistencia}',
                            'header' => 'Fichar',
                            'buttons' => [
                                'asistencia' => function($url, $model)
                                {
                                    return Html::a(
                                        '<span title="Fichaje" class="glyphicon glyphicon-calendar"></span>',
                                        Url::to(['asistencia/create'])
                                    );
                                }
                            ]
                            ],*/


                            ['class' => 'yii\grid\ActionColumn',
                            'template' => '{detalle}',
                            'header' => 'Fichar',
                            'buttons' => [
                                'detalle' => function($url, $model)
                                {
                                    return Html::button('', ['value' => Url::to(['asistencia/createajax','id_mascota'=>$model->id]), 'title' => 'Detalles', 'class' => 'showModalButton glyphicon glyphicon-calendar']);
                                }
                            ]
                            ],


                             [
                                'class'=>'yii\grid\ActionColumn',
                                'template'=>'{detalle}',
                                'header'=>'Nuevo Bono',
                                'buttons' => [
                                    'detalle' => function($url, $model)
                                    {
                                        return Html::button('', ['value' => Url::to(['bonocomprado/createajax','id_mascota'=>$model->id]), 'title' => 'Detalles', 'class' => 'showModalButton glyphicon glyphicon-plus']);
                                    }
                                ]
                            ],

                            [
                                'class'=>'yii\grid\DataColumn',
                                'label'=>'Bono Activo',
                                'enableSorting' => TRUE,
                                'value'=>function($data){
                                    $nomCompleto = "No Asignado";
                                    $lista_bonos = BonoComprado::find()->where(['id_mascota' => $data->id,'activo'=>1])->all();      
                                    if (count($lista_bonos)>=1)
                                    {
                                        if (count($lista_bonos)==1)
                                        {
                                            $bono = Bono::find()->where(['id'=>$lista_bonos[0]->id_bono])->one();
                                            $nomCompleto = $bono->tipo;
                                        }
                                        else
                                        {
                                        $nomCompleto = ">1";
                                        }

                                    }
                                    return $nomCompleto;
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
                        'dataProvider' => $dataProvider_asistencia,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'fecha',
                            'hora',
                            [
                                'class'=>'yii\grid\DataColumn',
                                'label'=>'Mascota',
                                'enableSorting' => TRUE,
                                'value'=>function($data){
                                    $nomCompleto = "No Asignado";
                                    if (isset($data->id_mascota))
                                    {
                                        $prop = Mascota::findOne($data->id_mascota);
                                        $nomCompleto = $prop->nombre;

                                    }
                                    return $nomCompleto;
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
