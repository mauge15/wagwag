<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\HistorialComportamientoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Historial Comportamientos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historial-comportamiento-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Historial Comportamiento', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_mascota',
            'ha_mordido',
            'ha_sido_mordido',
            'miedo_perro',
            // 'id_temperamento',
            // 'juega_perros',
            // 'juega_personas',
            // 'persona_desconocida',
            // 'otra_info',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
