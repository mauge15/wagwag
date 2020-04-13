<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Bono;
use app\models\Mascota;
use app\models\Propietario;
/* @var $this yii\web\View */
/* @var $model app\models\BonoComprado */

$this->title = "Detalles Bono";
$this->params['breadcrumbs'][] = ['label' => 'Bono Comprados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$propietario = Propietario::find()->where(['id' => $model->id_propietario])->one();
?>
<div class="bono-comprado-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
       
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Está seguro que desea eliminar?',
                'method' => 'post',
            ],
        ]) ?>
         <?= Html::a('Volver', ['/mascota'], [
            'class' => 'btn btn-info'
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [                      // the owner name of the model
                'label' => 'Mascota',
                'value' => Mascota::find()->where(['id' => $model->id_mascota])->one()->nombre,
            ],
           // 'id_mascota',
            //'id_bono',
            [                      // the owner name of the model
                'label' => 'Tipo de Bono',
                'value' => Bono::find()->where(['id' => $model->id_bono])->one()->tipo,
            ],
            //'id_propietario',
            [                      // the owner name of the model
                'label' => 'Propietario',
                'value' => $propietario->nombre." ".$propietario->apellido,
            ],
            'fecha_compra',
            'fecha_caducidad',
            'dias_utilizados',
            'dias_bono',
        ],
    ]) ?>

</div>
