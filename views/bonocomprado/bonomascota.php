<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Bono;
use app\models\Mascota;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BonoCompradoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bono Comprados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bono-comprado-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Nuevo Bono', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id_mascota',
            [
                'class'=>'yii\grid\DataColumn',
                'label'=>'Mascota',
                'enableSorting' => TRUE,
                'value'=>function($data){
                    $mascota = Mascota::findOne($data->id_mascota);
                    return $mascota->nombre;
                },
            ],
              [
                'class'=>'yii\grid\DataColumn',
                'label'=>'Bono',
                'enableSorting' => TRUE,
                'value'=>function($data){
                    $bono = Bono::findOne($data->id_bono);
                    return $bono->tipo;
                },
            ],
            'fecha_compra',
            'fecha_caducidad',
            'dias_utilizados',
            'dias_bono',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
