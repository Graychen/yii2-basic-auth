<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\App */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'App',
    ]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Apps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="app-update">

    <?= $this->render('_form', [
        'models' => $model,
    ]) ?>

</div>
