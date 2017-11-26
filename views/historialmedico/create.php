<?php

use yii\helpers\Html;
use app\models\Mascota;



/* @var $this yii\web\View */
/* @var $model app\models\HistorialMedico */

$mascota = Mascota::findOne($idMascota);

$this->title = $mascota->nombre;
$this->params['breadcrumbs'][] = ['label' => $mascota->nombre, 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Historial Médico'
?>
<div class="historial-medico-create">

    <h1><?= Html::encode($mascota->nombre) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'idMascota' => $mascota->id,
    ]) ?>

</div>
