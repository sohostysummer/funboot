<?php

namespace backend\modules\base\controllers;

use common\helpers\ArrayHelper;
use common\helpers\IdHelper;
use common\models\base\Role;
use common\models\base\UserRole;
use common\models\Store;
use Yii;
use common\models\User;
use common\models\ModelSearch;
use backend\controllers\BaseController;

/**
* User
*
* Class UserController
* @package backend\modules\base\controllers
*/
class UserController extends BaseController
{
    /**
    * @var User
    */
    public $modelClass = User::class;

    /**
     * @var string[]
     */
    public $likeAttributes = ['username', 'email', 'description'];

    /**
     * 可编辑字段
     *
     * @var int
     */
    protected $editAjaxFields = ['name', 'sort', 'remark'];

    /**
     * 可编辑字段
     *
     * @var int
     */
    protected $exportFields = [
        //'id' => 'text',
        'email' => 'text',
        'last_paid_at' => 'date',
        'consume_count' => 'text',
        'consume_amount' => 'text',
        'created_at' => 'date',
    ];

    /**
    * 列表页
    *
    * @return string
    * @throws \yii\web\NotFoundHttpException
    */
    /*public function actionIndex()
    {
        $searchModel = new ModelSearch([
            'model' => $this->modelClass,
            'scenario' => 'default',
            'likeAttributes' => $this->likeAttributes,
            'defaultOrder' => [
                'id' => SORT_DESC
            ],
            'pageSize' => Yii::$app->request->get('page_size', $this->pageSize),
        ]);

        // 管理员级别才能查看所有权限
        $params = Yii::$app->request->queryParams;
        if (!$this->isAdmin()) {
            $params['ModelSearch']['store_id'] = $this->getStoreId();
        }
        $dataProvider = $searchModel->search($params);

        return $this->render($this->action->id, [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }*/

    /**
     * ajax编辑/创建
     *
     * @return mixed|string|\yii\web\Response
     * @throws \yii\base\ExitException
     */
    public function actionEditAjax()
    {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);

        // ajax 校验
        $this->activeFormValidate($model);
        if ($model->load(Yii::$app->request->post())) {
            if (isset($model->user_id)) {
                UserRole::deleteAll(['user_id' => $model->user_id]);
            }
            if ($model->save()) {
                // 权限
                if (count($model->roles) > 0) {
                    foreach ($model->roles as $roleId) {
                        $userRole = new UserRole();
                        $userRole->user_id = $model->id;
                        $userRole->role_id = $roleId;
                        $userRole->save();
                    }
                }

                $this->flashSuccess();
            } else {
                Yii::error($model->errors);
                $this->flashError($this->getError($model));
            }

            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax($this->action->id, [
            'model' => $model,
        ]);
    }


    /**
     * 编辑/创建
     *
     * @return mixed
     */
    public function actionEdit()
    {
        $id = Yii::$app->request->get('id', null);
        $model = $this->findModel($id);

        $allRoles = ArrayHelper::map(Role::find()->where(['status' => Role::STATUS_ACTIVE])->asArray()->all(), 'id', 'name');

        if (Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if (isset($model->id)) {
                    UserRole::deleteAll(['user_id' => $model->id]);
                }

                if ($model->save()) {
                    // 保存用户角色关系
                    $roles = Yii::$app->request->post('User')['roles'];
                    if (count($roles) > 0) {
                        foreach ($roles as $roleId) {
                            $userRole = new UserRole();
                            $userRole->user_id = $model->id;
                            $userRole->role_id = $roleId;
                            if (!$userRole->save()) {
                                Yii::$app->logSystem->db($userRole->errors);
                            }
                        }
                    }

                    Yii::$app->cacheSystem->clearUserPermissionIds($model->id);
                    $this->flashSuccess();
                    return $this->redirect(['index']);
                } else {
                    Yii::error($model->errors);
                    $this->flashError('操作失败' . json_encode($model->errors));
                }
            }
        }

        $model->roles = ArrayHelper::getColumn(UserRole::find()->filterWhere(['user_id' => $id])->asArray()->all(), 'role_id');

        return $this->render($this->action->id, [
            'model' => $model,
            'allRoles' => $allRoles,
        ]);
    }

    /**
     * 跳转登录
     *
     * @param $id
     * @return mixed
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionLogin($id)
    {
        $model = $this->findModelAction($id);
        if (!$model) {
            return $this->redirectError(Yii::$app->request->referrer, Yii::t('app', 'Invalid id'));
        }

        $store = $model->store_id > 0 ? Store::findOne($model->store_id) : null;
        if ($model) {
            $model->token = substr(IdHelper::snowFlakeId(), 0, 8);
            if ($model->save()) {
                return $this->redirect('http://' . $store->host_name . '/site/login-backend?token=' . $model->token);
            }
        }

        return $this->goBack();
    }

}
