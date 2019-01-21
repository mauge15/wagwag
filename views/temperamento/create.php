<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Temperamento */

$this->title = 'Create Temperamento';
$this->params['breadcrumbs'][] = ['label' => 'Temperamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="temperamento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
