<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Anotacion */

$this->title = 'Update Anotacion: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Anotacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="anotacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
