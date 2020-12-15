<?php

namespace backend\modules\base\controllers;

use common\helpers\ArrayHelper;
use common\models\base\MessageSend;
use common\models\User;
use Yii;
use common\models\base\Message;
use common\models\ModelSearch;
use backend\controllers\BaseController;

/**
 * Message
 *
 * Class MessageController
 * @package backend\modules\base\controllers
 */
class MessageController extends BaseController
{
    /**
      * @var Message
      */
    public $modelClass = Message::class;

    /**
      * 模糊查询字段
      * @var string[]
      */
    public $likeAttributes = ['name'];

    /**
     * 可编辑字段
     *
     * @var int
     */
    protected $editAjaxFields = ['name', 'sort'];

    /**
     * 导入导出字段
     *
     * @var int
     */
    protected $exportFields = [
        'id' => 'text',
        'name' => 'text',
        'type' => 'select',
    ];

    /**
      * ajax编辑/创建
      *
      * @return mixed|string|\yii\web\Response
      * @throws \yii\base\ExitException
      */
    public function actionEditAjax()
    {
        $id = Yii::$app->request->get('id', null);
        $model = $this->findModel($id);

        $allUsers = ArrayHelper::map(User::find()->where(['status' => User::STATUS_ACTIVE])->asArray()->all(), 'id', 'username');

        // ajax 校验
        $this->activeFormValidate($model);
        if ($model->load(Yii::$app->request->post())) {
            $sendUsers = Yii::$app->request->post('Message')['sendUsers'] ?? null;
            if ($sendUsers && count($sendUsers) > 0) {
                $model->send_user = implode('|', $sendUsers);
            }
            $model->send_type = ArrayHelper::arrayToInt($model->send_type);

            if ($model->save()) {
                if (!$id) { //编辑的新消息才发送
                    Yii::$app->messageSystem->send($model, Yii::$app->user->id);
                }
                $this->flashSuccess();
            } else {
                Yii::$app->logSystem->db($model->errors);
                $this->flashError($this->getError($model));
            }

            return $this->redirect(Yii::$app->request->referrer);
        }

        $model->sendUsers = explode('|', $model->send_user);
        $model->send_type = ArrayHelper::intToArray($model->send_type, $this->modelClass::getSendTypeLabels());
        return $this->renderAjax($this->action->id, [
            'model' => $model,
            'allUsers' => $allUsers,
        ]);
    }

    /**
     * @param $id
     * @return bool|void
     */
    protected function afterDeleteModel($id, $soft = false, $tree = false)
    {
        MessageSend::deleteAll(['status' => MessageSend::STATUS_DELETED], ['message_id' => $id]);
    }
}