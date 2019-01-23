<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Mascota;

/* @var $this yii\web\View */
/* @var $model app\models\Anotacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anotacion-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'id_mascota')->hiddenInput(['value'=>$id_mascota])->label(false); ?>

    <?= $form->field($model, 'anotacion')->textarea(['rows' => 6]) ?>

     <?= $form->field($model, 'fecha')->hiddenInput(['value'=>date("Y-m-d")])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
