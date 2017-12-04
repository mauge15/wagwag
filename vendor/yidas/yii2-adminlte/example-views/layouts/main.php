<?php
use yii\helpers\Html;
/* @var $this \yii\web\View */
/* @var $content string */
if (Yii::$app->controller->action->id === 'login') { 

    /**
     * Do not use this code in your template. Remove it. 
     * Instead, use the code  $this->layout = '//main-login'; in your controller.
     */
    echo $this->render('login', ['content' => $content]);
    return;
}

/**
 * You could set your AppAsset depended with AdminlteAsset 
 */
// \backend\assets\AppAsset::register($this);
// \app\assets\AppAsset::register($this);
$adminlteAsset = yidas\yii\adminlte\AdminlteAsset::register($this);

$distPath = $adminlteAsset->baseUrl;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?= Html::csrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php $this->beginBody() ?>
<div class="wrapper">

  <?= $this->render('main/header.php', [
      'directoryAsset' => $distPath
      ]) ?>

  <?= $this->render('main/aside.php', [
      'directoryAsset' => $distPath
      ]) ?>

  <?= $this->render('main/content.php', [
      'content' => $content, 'directoryAsset' => $distPath
      ]) ?>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

