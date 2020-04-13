<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BonoComprado */

$this->title = 'Nuevo Bono';
$this->params['breadcrumbs'][] = ['label' => 'Nuevo Bono', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bono-comprado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formAjax', [
        'model' => $model,
        'id_mascota' => $id_mascota,
    ]) ?>

</div>
