<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Mascota;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AnotacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anotaciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anotacion-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Anotacion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
           /* [
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
            ],*/
            //'id',
            //'id_mascota',
            'nombre:ntext',
            'anotacion:ntext',
            'fecha',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
