<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Mascota */

$this->title = 'Nueva Mascota';
$this->params['breadcrumbs'][] = ['label' => 'Mascotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mascota-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
