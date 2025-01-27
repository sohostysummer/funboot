<?php

use common\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\enums\YesNo;
use common\models\bbs\Comment as ActiveModel;

/* @var $this yii\web\View */
/* @var $model common\models\bbs\Comment */
/* @var $form yii\widgets\ActiveForm */

$this->title = ($model->id ? Yii::t('app', 'Edit ') : Yii::t('app', 'Create ')) . Yii::t('app', 'Comment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin([
    'fieldConfig' => [
        'template' => "<div class='col-sm-2 text-sm-right'>{label}</div><div class='col-sm-10'>{input}\n{hint}\n{error}</div>",
        'options' => ['class' => 'form-group row'],
    ],
]); ?>
<div class="row">
    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
        <div class="card">
            <div class="card-header"><h2 class="card-title"><?= $this->title ?></h2></div>
            <div class="card-body">
                <div class="col-sm-12">
                    <?= $form->field($model, 'topic_id')->dropDownList(ActiveModel::getTopicIdLabels()) ?>
                    <?= $form->field($model, 'user_id')->dropDownList(ActiveModel::getUserIdLabels()) ?>
                    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
                    <?= $form->field($model, 'like')->textInput() ?>
                    <?= $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'ip_info')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'sort')->radioList(YesNo::getLabels()) ?>
                </div>
            </div>
            <div class="card-footer">
                <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
                <span class="btn btn-default" onclick="history.go(-1)"><?= Yii::t('app', 'Back') ?></span>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
