<?php

namespace backend\controllers;

use common\helpers\ImageHelper;
use common\helpers\Url;
use common\models\base\Message;
use Yii;
use common\models\base\MessageSend;
use common\models\ModelSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\components\controller\BaseController;

/**
 * MessageSend
 *
 * Class MessageController
 * @package backend\controllers
 */
class MessageController extends BaseController
{

    /**
      * @var string[]
      */
    public $likeAttributes = ['name'];

    /**
     * @var int
     */
    public $pageSize = 20;

    /**
     * 行为控制
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->layout = 'main';
        parent::beforeAction($action);
        return true;
    }

    /**
      * 列表页
      * @param int $status
      * @return string
      * @throws \yii\web\NotFoundHttpException
      */
    public function actionIndex($status = 0)
    {
        $searchModel = new ModelSearch([
            'model' => MessageSend::class,
            'scenario' => 'default',
            'likeAttributes' => $this->likeAttributes,
            'defaultOrder' => [
                'id' => SORT_DESC
            ],
            'pageSize' => Yii::$app->request->get('page_size', $this->pageSize),
        ]);

        $params = Yii::$app->request->queryParams;
        $params['ModelSearch']['user_id'] = Yii::$app->user->id;
        $params['ModelSearch']['status'] = $status;
        $dataProvider = $searchModel->search($params);

        $unread = MessageSend::find()->where(['user_id' => Yii::$app->user->id, 'status' => MessageSend::STATUS_UNREAD])->count();

        return $this->render($this->action->id, [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'unread' => $unread,
        ]);
    }

    /**
      * 列表页
      * @param int $status
      * @return string
      * @throws \yii\web\NotFoundHttpException
      */
    public function actionList($status = 0)
    {
        $unread = MessageSend::find()->where(['user_id' => Yii::$app->user->id, 'status' => MessageSend::STATUS_UNREAD])->count();

        $models = MessageSend::find()->where(['user_id' => Yii::$app->user->id, 'status' => MessageSend::STATUS_UNREAD])
            ->with(['from' => function ($query) {
                $query->select(['username', 'avatar', 'name']);
            }])
            ->orderBy(['created_at' => SORT_DESC])
            ->limit(3)
            ->asArray()
            ->all();

        $list = [];
        foreach ($models as $model) {
            $item = $model;
            $item['url'] = Url::to(['message/view', 'id' => $model['id']], true);
            $item['avatar'] = ImageHelper::getAvatar($model['from']['avatar']);
            $item['username'] = strlen($model['from']['name']) > 0 ? $model['from']['name'] : $model['from']['username'];
            $item['created_at'] = (time() - $model['created_at']) > 86400 ? Yii::$app->formatter->asDatetime($model['created_at']) : Yii::$app->formatter->asRelativeTime($model['created_at']);

            $list[] = $item;
        }

        return $this->success($list, ['unread' => $unread]);
    }

    /**
     * 编辑/创建
     *
     * @return mixed
     */
    public function actionView($id)
    {
        $model = MessageSend::findOne($id);
        if (!$model) {
            return $this->redirectError(Yii::$app->request->referrer, Yii::t('app', 'Invalid id'));
        }

        $model->status = MessageSend::STATUS_READ;
        $model->save();

        $unread = MessageSend::find()->where(['user_id' => Yii::$app->user->id, 'status' => MessageSend::STATUS_UNREAD])->count();
        return $this->render($this->action->id, [
            'model' => $model,
            'unread' => $unread,
        ]);
    }

    /**
     * 删除
     *
     * @param $id
     * @return mixed
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = MessageSend::findOne($id);
        if (!$model) {
            return $this->redirectError(Yii::$app->request->referrer, Yii::t('app', 'Invalid id'));
        }

        $model->status = MessageSend::STATUS_RECYCLE;
        if (!$model->save()) {
            Yii::$app->logSystem->db($model->errors);
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->redirectSuccess(Yii::$app->request->referrer, Yii::t('app', 'Delete Successfully'));
    }
}
