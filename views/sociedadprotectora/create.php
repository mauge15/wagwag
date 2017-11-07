<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SociedadProtectora */

$this->title = 'Create Sociedad Protectora';
$this->params['breadcrumbs'][] = ['label' => 'Sociedad Protectoras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sociedad-protectora-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
