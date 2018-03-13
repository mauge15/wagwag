<?php

use yii\helpers\Html;
use app\models\Mascota;


/* @var $this yii\web\View */
/* @var $model app\models\Asistencia */

$this->title = 'Create Asistencia';
$this->params['breadcrumbs'][] = ['label' => 'Asistencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$mascota = Mascota::findOne($id_mascota);
?>
<div class="asistencia-create">

    <h3><?= Html::encode($mascota->nombre) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
        'id_mascota' => $id_mascota,
    ]) ?>

</div>
