<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Mascota;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AsistenciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asistencias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asistencia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Asistencia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php /* GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_mascota',
            'hora',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);*/ ?>


<?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
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
                            'fecha',
                            'hora',
                           
                        ],
                        ]); ?>   

</div>
