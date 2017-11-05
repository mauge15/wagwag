<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MascotaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mascota-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'fecha_nac') ?>

    <?= $form->field($model, 'chip') ?>

    <?= $form->field($model, 'id_raza') ?>

    <?php // echo $form->field($model, 'sexo') ?>

    <?php // echo $form->field($model, 'esterilizado') ?>

    <?php // echo $form->field($model, 'fecha_ult_celo') ?>

    <?php // echo $form->field($model, 'adoptado') ?>

    <?php // echo $form->field($model, 'id_protectora') ?>

    <?php // echo $form->field($model, 'id_historial_medico') ?>

    <?php // echo $form->field($model, 'id_historial_comportamiento') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
