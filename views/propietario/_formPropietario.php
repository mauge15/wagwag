<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\AutoComplete;
use yii\widgets\View;
use app\models\Propietario;
use app\models\Veterinario;
use app\models\SociedadProtectora;
use app\models\Temperamento;
use app\models\Raza;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\Propietario */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
//$type_list= Referencia::model()->findAll();
//$type_list= ArrayHelper::map($listReferencia,'id','tipo');

?>

<div class="row">
    <div class="col-sm-12">
        <div class="box box-solid box-info" data-widget="box-widget">
            <div class="box-header">
                <h3 class="box-title">Datos Propietario</h3>
            </div>
            <div class="box-body">
                <!--form propietario -->
                <div class="propietario-form">
                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'dni')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'telefono')->textInput() ?>
                    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'cod_postal')->textInput() ?>
                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'persona_contacto')->textInput(['maxlength' => true]) ?> 
                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
                <!--fin form historial comportamiento-->    
            </div>
        </div>
    </div>
</div>
