<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ComportamientoObservado */

$this->title = 'Create Comportamiento Observado';
$this->params['breadcrumbs'][] = ['label' => 'Comportamiento Observados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comportamiento-observado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
