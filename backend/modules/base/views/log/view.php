<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\enums\YesNo;
use common\models\base\Log as ActiveModel;

/* @var $this yii\web\View */
/* @var $model common\models\base\Log */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="log-view">
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['edit', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'table table-hover box'],
        'attributes' => [
            'id',
            'store_id',
            'user_id',
            'name',
            'url:url',
            ['attribute' => 'method', 'value' => function ($model) { return ActiveModel::getMethodLabels($model->method); }, ],
            'params:ntext',
            'user_agent',
            ['attribute' => 'agent_type', 'value' => function ($model) { return ActiveModel::getAgentTypeLabels($model->agent_type); }, ],
            'ip',
            'ip_info',
            'code',
            'msg',
            'data:ntext',
            'cost_time',
            ['attribute' => 'type', 'value' => function ($model) { return ActiveModel::getTypeLabels($model->type); }, ],
            'sort',
            'status',
            'created_at:datetime',
            'updated_at:datetime',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
