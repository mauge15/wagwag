<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BonoComprado */

$this->title = 'Create Bono Comprado';
$this->params['breadcrumbs'][] = ['label' => 'Bono Comprados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bono-comprado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
