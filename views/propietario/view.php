<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\Models\Referencia;

/* @var $this yii\web\View */
/* @var $model app\models\Propietario */

$this->title = $model->nombre." ".$model->apellido;
$this->params['breadcrumbs'][] = ['label' => 'Propietarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="propietario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Añadir Mascota', ['newAnimal', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'apellido',
            'telefono',
            'dni',
            'direccion',
            'cod_postal',
            'email:email',
            'persona_contacto',
            ['label'=>'Como nos conoció?',
             'value'=> Referencia::findOne($model->id_referencia)->tipo],
        ],
    ]) ?>

</div>
