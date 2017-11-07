<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Temperamento */

$this->title = 'Update Temperamento: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Temperamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="temperamento-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
