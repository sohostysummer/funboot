<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\enums\YesNo;
use common\models\school\Student as ActiveModel;

/* @var $this yii\web\View */
/* @var $model common\models\school\Student */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Students'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card mt-2 student-view">
    <div class="card-header">
        <?= $model->name ?>
    </div>

    <div class="card-body">

        <?= DetailView::widget([
            'model' => $model,
            'options' => ['class' => 'table table-bordered table-hover box', 'style' => 'table-layout:fixed; width:100%;'],
            'attributes' => [
                'id',
                'store_id',
                'name',
                ['attribute' => 'type', 'value' => function ($model) { return ActiveModel::getTypeLabels($model->type); }, ],
                'sort',
                ['attribute' => 'status', 'value' => function ($model) { return ActiveModel::getStatusLabels($model->status); }, ],
                'created_at:datetime',
                'updated_at:datetime',
                'created_by',
                'updated_by',
            ],
        ]) ?>

    </div>
</div>