<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Anotacion */

$this->title = 'Create Anotacion';
$this->params['breadcrumbs'][] = ['label' => 'Anotacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anotacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
         'id_mascota' => $id_mascota
    ]) ?>

</div>
