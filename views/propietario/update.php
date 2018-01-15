<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Propietario */

$this->title = 'Update Propietario: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Propietarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="propietario-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formPropietario', [
        'model' => $model,
    ]) ?>

</div>
