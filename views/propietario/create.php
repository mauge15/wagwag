<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Propietario */

$this->title = 'Nuevo Cliente';
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="propietario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'listReferencia' => $listReferencia,
    ]) ?>

</div>
