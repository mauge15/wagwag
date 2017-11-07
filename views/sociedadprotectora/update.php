<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SociedadProtectora */

$this->title = 'Update Sociedad Protectora: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sociedad Protectoras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sociedad-protectora-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
