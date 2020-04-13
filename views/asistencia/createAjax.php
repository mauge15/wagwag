<?php

use yii\helpers\Html;
use app\models\Mascota;
use yii\web\View;


/* @var $this yii\web\View */
/* @var $model app\models\Asistencia */
$ajaxForm = <<<JS
$("#boton_prueba").click(function(){ window.alert('hola dentro de create'); });
JS;

$this->registerJs($ajaxForm, View::POS_READY);

$ajaxForm_asistencia = <<<JS
    $("#asistencia-form").submit(function(event) {
            event.preventDefault(); // stopping submitting
            //window.alert("Forma Ajax");
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
                    $.pjax.reload('#gridViewMascota', "");
                    //$("#modal").modal('toggle');
                    //$("#modal .close").click();
                    alert(response.data.message);
                    $("#modal").modal('hide');
                }
            })
            .fail(function() {
                console.log("error");
            }); 
        //window.alert("termina");
        });
JS;

$this->registerJs($ajaxForm_asistencia, View::POS_READY);

$this->title = 'Create Asistencia';
$this->params['breadcrumbs'][] = ['label' => 'Asistencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$mascota = Mascota::findOne($id_mascota);
?>
<div class="asistencia-create">
    <h3><?= Html::encode($mascota->nombre) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
        'id_mascota' => $id_mascota,
    ]) ?>

</div>
