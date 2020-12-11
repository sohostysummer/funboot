<?php

namespace backend\modules\base\controllers;

use common\helpers\EchartsHelper;
use Yii;
use common\models\base\Log;
use common\models\ModelSearch;
use backend\controllers\BaseController;

/**
* Log
*
* Class LogController
* @package backend\modules\base\controllers
*/
class LogController extends BaseController
{
    /**
    * @var Log
    */
    public $modelClass = Log::class;

    /**
     * @var string[]
     */
    public $likeAttributes = ['name', 'url', 'ip'];

    /**
     * 可编辑字段
     *
     * @var int
     */
    protected $editAjaxFields = ['name', 'sort'];

    /**
     * 可编辑字段
     *
     * @var int
     */
    protected $exportFields = [
        'id' => 'text',
        'name' => 'text',
        'type' => 'select',
    ];

    /**
     * 列表页
     * @param int $type
     * @return string
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionIndex($type = 1)
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

        $params = Yii::$app->request->queryParams;
        if ($type > 0) {
            $params['ModelSearch']['type'] = $type;
        }
        $dataProvider = $searchModel->search($params);

        return $this->render($this->action->id, [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'type' => $type,
        ]);
    }

    /**
      * ajax编辑/创建
     *
     * @return mixed|string|\yii\web\Response
     * @throws \yii\base\ExitException
     */
    /*public function actionEditAjax()
    {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);

        // ajax 校验
        $this->activeFormValidate($model);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $this->flashSuccess();
            } else {
                $this->flashError($this->getError($model));
            }

            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->renderAjax($this->action->id, [
            'model' => $model,
        ]);
    }*/

    /**
     * 错误统计
     * @param string $type
     * @return array|mixed
     */
    public function actionStatAjaxError($type = null)
    {
        // 返回Modal视图
        if (empty($type)) {
            return $this->renderAjax($this->action->id);
        }

        // 返回json数据
        $fields = [];
        $codes = [400, 401, 403, 405, 422, 429, 500];
        foreach ($codes as $code) {
            $fields[$code] = $code . Yii::t('app', 'Error');
        }

        // 获取时间和格式化
        list($time, $format) = EchartsHelper::getFormatTime($type);

        $data = $this->getEchartStat($this->modelClass::TYPE_ERROR, $codes, $fields, $time, $format);
        return $this->success($data);
    }

    /**
     * 错误统计
     * @param string $type
     * @return array|mixed
     */
    public function actionStatAjaxLogin($type = null)
    {
        // 返回Modal视图
        if (empty($type)) {
            return $this->renderAjax($this->action->id);
        }

        // 返回json数据
        $fields = [];
        $codes = [200, 599];
        foreach ($codes as $code) {
            $fields[$code] = Log::getCodeLabels($code);
        }

        // 获取时间和格式化
        list($time, $format) = EchartsHelper::getFormatTime($type);

        $data = $this->getEchartStat($this->modelClass::TYPE_LOGIN, $codes, $fields, $time, $format);
        return $this->success($data);
    }

    protected function getEchartStat($type, $codes, $fields, $time, $format)
    {
        // 获取数据
        $data = EchartsHelper::lineOrBarInTime(function ($startTime, $endTime, $formatting) use ($type, $codes) {
            $statData = $this->modelClass::find()
                ->select(["from_unixtime(created_at, '$formatting') as time", 'count(*) as count', 'code'])
                ->andWhere(['between', 'created_at', $startTime, $endTime])
                ->andWhere(['type' => $type])
                ->andWhere(['in', 'code', $codes])
                ->groupBy(['time', 'code'])
                ->asArray()
                ->all();

            return EchartsHelper::regroupTimeData($statData, 'code');
        }, $fields, $time, $format);

        return $data;
    }
}
