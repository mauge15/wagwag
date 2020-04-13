<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Propietario;
use app\models\Mascota;
use app\models\Vacuna;
/* @var $this yii\web\View */
/* @var $searchModel app\models\VacunaMascotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Próximas Vacunas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacuna-mascota-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           //'id',
            //'id_mascota',
            //'id_vacuna',
            //'id_mascota',
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
            [
                'class'=>'yii\grid\DataColumn',
                'label'=>'Propietario',
                'enableSorting' => TRUE,
                'value' => function($data){
                    $nomCompleto = "No encontrado";
                    if (isset($data->id_mascota))
                    {
                        $masc = Mascota::findOne($data->id_mascota);
                        $nomCompleto = "Mascota existe";
                        if (isset($masc->id_propietario))
                        {
                            $prop = Propietario::findOne($masc->id_propietario);
                            $nomCompleto = $prop->nombre." ".$prop->apellido; 
                        }
                        else
                        {
                            $nomCompleto = "No existe propietario";
                        }
                        
                    }
                    return $nomCompleto;
                },
            ],
            [
                'class'=>'yii\grid\DataColumn',
                'label'=>'Vacuna',
                'enableSorting' => TRUE,
                'value' => function($data){
                    $nomCompleto = "NA";
                    if (isset($data->id_vacuna))
                    {
                        $vac = Vacuna::findOne($data->id_vacuna);
                        $nomCompleto = $vac->nombre;
                    }
                    return $nomCompleto;
                }
            ],
            'fecha',
            'proxima_fecha',
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
