<?php

use common\helpers\Html;
use common\helpers\Url;
use yii\widgets\ActiveForm;
use common\components\enums\YesNo;
use common\models\base\PointLog as ActiveModel;


/* @var $this yii\web\View */
/* @var $model common\models\base\PointLog */
/* @var $form yii\widgets\ActiveForm */

$form = ActiveForm::begin([
    'id' => $model->formName(),
    'enableAjaxValidation' => true,
    'validationUrl' => Url::to(['edit-ajax', 'id' => $model['id']]),
    'fieldConfig' => [
        'template' => "<div class='col-sm-2 text-sm-right'>{label}</div><div class='col-sm-10'>{input}\n{hint}\n{error}</div>",
    ],
]);
?>
    <div class="modal-header">
        <h4 class="modal-title"><?= $model->name ?: Yii::t('app', 'Basic info') ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
    </div>
    <div class="modal-body">
        <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'store_id')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'change')->textInput() ?>
        <?= $form->field($model, 'original')->textInput() ?>
        <?= $form->field($model, 'balance')->textInput() ?>
        <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'type')->textInput() ?>
        <?= $form->field($model, 'sort')->textInput() ?>
        <?= $form->field($model, 'status')->textInput() ?>
        <?= $form->field($model, 'created_at')->textInput() ?>
        <?= $form->field($model, 'updated_at')->textInput() ?>
        <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal"><?= Yii::t('app', 'Close') ?></button>
        <button class="btn btn-primary" type="submit"><?= Yii::t('app', 'Submit') ?></button>
    </div>
<?php ActiveForm::end(); ?>