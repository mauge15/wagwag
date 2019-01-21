<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\HistorialMedicoVacuna */

$this->title = 'Create Historial Medico Vacuna';
$this->params['breadcrumbs'][] = ['label' => 'Historial Medico Vacunas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="historial-medico-vacuna-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
