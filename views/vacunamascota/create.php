<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\VacunaMascota */

$this->title = 'Create Vacuna Mascota';
$this->params['breadcrumbs'][] = ['label' => 'Vacuna Mascotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vacuna-mascota-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
