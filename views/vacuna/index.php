<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VacunaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vacunas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacuna-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Vacuna', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'duracion_mes',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
