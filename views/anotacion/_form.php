<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Mascota;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $model app\models\Anotacion */
/* @var $form yii\widgets\ActiveForm */

$ajaxForm = <<<JS
//$(document).pjax('a', '#pjax-container');

    $(".anotacion-ajax-form").submit(function(event) {
            event.preventDefault(); // stopping submitting
            event.stopImmediatePropagation();
           var data = $(this).serializeArray();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: data
            })
            .done(function(response) {
                if (response.data.success == true) {
                    alert(response.data.message);
                    $("#modal").modal('hide');
                }
            })
            .fail(function() {
                console.log("error");
            });
        });
JS;

$this->registerJs($ajaxForm, View::POS_READY);

?>

<div class="anotacion-form">

    <?php $form = ActiveForm::begin([ 
                                            'action' => ['anotacion/createajax'], 
                                            'options' => [
                                              'class' => 'anotacion-ajax-form'
                                              ]
                                            ]); ?>
    <?= $form->field($model, 'id_mascota')->hiddenInput(['value'=>$id_mascota])->label(false); ?>

    <?= $form->field($model, 'anotacion')->textarea(['rows' => 6]) ?>

     <?= $form->field($model, 'fecha')->hiddenInput(['value'=>date("Y-m-d")])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
