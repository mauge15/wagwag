<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Raza;
use app\models\Propietario;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MascotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mascotas';
$this->params['breadcrumbs'][] = $this->title;
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
