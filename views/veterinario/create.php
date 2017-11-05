<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Veterinario */

$this->title = 'Create Veterinario';
$this->params['breadcrumbs'][] = ['label' => 'Veterinarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="veterinario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
