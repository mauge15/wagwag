<?php

use yii\helpers\Html;
use app\models\Mascota;


/* @var $this yii\web\View */
/* @var $model app\models\HistorialComportamiento */

$mascota = Mascota::findOne($idMascota);

$this->title = $mascota->nombre;
$this->params['breadcrumbs'][] = ['label' => $mascota->nombre, 'url' => ['index']];
$this->params['breadcrumbs'][] = "Historial de Comportamiento";
?>
<div class="historial-comportamiento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'listTemperamento' => $listTemperamento,
        'idMascota' => $mascota->id,
    ]) ?>

</div>
