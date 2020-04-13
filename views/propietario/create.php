<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Propietario */

$this->title = 'Nuevo Registro';
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

	<?= $this->render('_form', [
					        'model' => $modelPropietario,
					        'modelMascota' => $modelMascota,
                  			'modelHistMedico' => $modelHistMedico,
                  			'modelHistComp' => $modelHistComp,
							'listReferencia' => $listReferencia,
							'vacunaDataProvider' => $vacunaDataProvider,
					    ]) ?>

 

