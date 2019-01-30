<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Raza;
use app\models\Propietario;
use yii\web\JsExpression;
use yii\helpers\Url;
use yii\jui\Dialog;
use yii\web\View;
use yii\bootstrap\Modal;
use app\models\Bono;
use app\models\SociedadProtectora;


/* @var $this yii\web\View */
/* @var $searchModel app\models\MascotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mascotas';
$this->params['breadcrumbs'][] = $this->title;



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
?>
<div class="mascota-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nueva Mascota', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
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
            'header' => 'Acciones'],
            ['class' => 'yii\grid\ActionColumn',
                'header' => 'Info Interna',
                'template'=>'{web}',
                'buttons'=> [
                    'web' => function($url,$model,$key) {
                        return Html::button('', ['value' => Url::to(['anotacion/create','id_mascota'=>$model->id]), 'title' => 'Información Interna', 'class' => 'showModalButton glyphicon glyphicon-plus']);
                    },
                    'twitter' => function ($url, $model, $key){
                        return Html::a('<span class="glyphicon glyphicon-picture"</span>',
                            'twitter');
                    }
                ]
            ]

        ],
    ]); ?>
</div>
