<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\HistorialComportamiento */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Historial Comportamientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historial-comportamiento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_mascota',
            'ha_mordido',
            'ha_sido_mordido',
            'miedo_perro',
            'id_temperamento',
            'juega_perros',
            'juega_personas',
            'persona_desconocida',
            'otra_info',
        ],
    ]) ?>

</div>
