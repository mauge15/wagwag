<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Raza;
use app\models\Sociedadprotectora;

/* @var $this yii\web\View */
/* @var $model app\models\Mascota */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Mascotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$actionHistMedico = 'view';
$actionHistComp ='view';
if(is_null($model->id_historial_medico))
{
    $actionHistMedico = 'create';
}
if (is_null($model->id_historial_comportamiento))
{
    $actionHistComp = 'create';
}
?>
<div class="mascota-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(($actionHistMedico=='create') ? 'Añadir Historial Medico' : 'Ver Historial Médico', 
        [($actionHistMedico=='create') ? 'historial' : 'historialmedico/view2', 'id' => $model->id_historial_medico,'id_historial_medico' => $model->id_historial_medico,'id_mascota'=> $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(is_null($model->id_historial_comportamiento) ? 'Añadir Historial de Comportamiento':'Ver Historial de Comportamiento', [is_null($model->id_historial_comportamiento) ? 'historialcomportamiento' : 'historialcomportamiento/view2', 'id' => $model->id_historial_comportamiento,'id_historial_comportamiento' => $model->id_historial_comportamiento, 'id_mascota' => $model->id ], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
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
            'nombre',
            'fecha_nac',
            'chip',
            ['label'=>'Raza',
            'value'=>Raza::findOne($model->id_raza)->nombre],
            ['label'=>'Sexo',
            'value'=> ($model->sexo=="m") ? 'Macho' : 'Hembra'],
            ['label'=>'Esterilizado',
            'value'=>($model->esterilizado==1) ? 'Si' : 'No'],
            'fecha_ult_celo',
            ['label'=>'Adoptado',
            'value'=>($model->adoptado==1) ? 'Si':'No'],
            ['label'=>'Protectora',
            'value'=> ($model->adoptado==1)? Sociedadprotectora::findOne($model->id_protectora)->nombre : '-'],
            'id_historial_medico',
            'id_historial_comportamiento',
        ],
    ]) ?>

</div>
