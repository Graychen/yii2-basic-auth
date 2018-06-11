<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Apps');
$this->params['breadcrumbs'][] = $this->title;
?>
<p>
    <?= Html::a('添加', ['create'], ['class' => 'btn btn-success']) ?>
</p>
<div class="app-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'app_name',
            'app_description',
            [
                'attribute' => 'num',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->getNum($model->id);
                }
            ],
            // 'app_key',
            // 'app_secret',
            // 'created_at:datetime',
            // 'updated_at:datetime',
            // 'status
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete} {applog}',
            'buttons' => [
            'applog' => function ($url, $model, $key) {
                $appId = $model->id;
                $url = \yii\helpers\Url::to(['app-log/index', 'app_id' => $appId]);
                return Html::a("访问日志", $url);
            }
            ]
            ],
        ]
    ]); ?>
