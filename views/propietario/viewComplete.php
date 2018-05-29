<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Referencia;
use app\models\Raza;
use app\models\Temperamento;

/* @var $this yii\web\View */
/* @var $model app\models\Propietario */

$this->title = $modelPropietario->nombre." ".$modelPropietario->apellido;
$this->params['breadcrumbs'][] = ['label' => 'Propietarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="propietario-view">

    <h1>Cliente: <?= Html::encode($this->title) ?></br>Número: 23423424</h1>

    <p>
        
        <?= Html::a('Eliminar', ['delete', 'id' => $modelPropietario->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <h3>Datos Propietario</h3>
    <?= Html::a('Editar', ['update', 'id' => $modelPropietario->id], ['class' => 'btn btn-primary']) ?>

    <?= DetailView::widget([
        'model' => $modelPropietario,
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
             'value'=> Referencia::findOne($modelPropietario->id_referencia)->tipo],
        ],
    ]) ?>

    <h3>Datos Mascota</h3>
    <?= Html::a('Editar', ['mascota/update', 'id' => $modelMascota->id], ['class' => 'btn btn-primary']) ?>


    <?= DetailView::widget([
        'model' => $modelMascota,
        'attributes' => [
            'nombre' ,
            'fecha_nac' ,
            'chip',
            ['label'=>'Raza',
            'value' => Raza::findOne($modelMascota->id_raza)->nombre],
            'sexo',
            'esterilizado',
            'fecha_ult_celo',
            'adoptado' ,
            /*'id_protectora' => 'Asociación Protectora',
            'id_veterinario' => 'Veterinario',
            'id_historial_medico' => 'Id Historial Medico',
            'id_historial_comportamiento' => 'Id Historial Comportamiento',*/
        ],
    ]) ?>

    <h3>Historial Comportamiento</h3>
  <?= Html::a('Editar', ['historialcomportamiento/update', 'id' => $modelHistComp->id], ['class' => 'btn btn-primary']) ?>

      <?= DetailView::widget([
        'model' => $modelHistComp,
        'attributes' => [
            'ha_mordido' ,
            'ha_sido_mordido' ,
            'miedo_perro' ,
            ['label'=>'Temperamento',
            'value' => (Temperamento::findOne($modelHistComp->id_temperamento))->descripcion],
            'juega_perros',
            'juega_personas' ,
            'persona_desconocida' ,
            'encuentro_perro' ,
            'miedos' ,
            'protege_cosas' ,
            'gusta_jugar' ,
            'otra_info' ,
        ],
    ]) ?>

    <h3>Historial Médico</h3>
  <?= Html::a('Editar', ['historialmedico/update', 'id' => $modelHistMedico->id], ['class' => 'btn btn-primary']) ?>

     <?= DetailView::widget([
        'model' => $modelHistMedico,
        'attributes' => [
            'enf_cardiaca' ,
            'ale_alimentaria' ,
            'ale_cutanea' ,
            'otras_limit' ,
            'cancer' ,
            'enf_endocrina',
            'otras' ,
        ],
    ]) ?>


</div>
