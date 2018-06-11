<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\App */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Apps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'models' => $model,
        'attributes' => [
            'id',
            'app_name',
            'app_description',
            'app_key',
            'app_secret',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute'=>'status',
                'value'=>function ($model) {
                    if ($model->status==0) {
                        return "开发状态";
                    } elseif ($model->status==1) {
                        return "部署状态";
                    }
                }
            ]
        ],
    ]) ?>

</div>
