<?php
namespace common\components\base;

use common\helpers\CommonHelper;
use common\helpers\IdHelper;
use common\helpers\IpHelper;
use common\job\base\LogJob;
use common\models\base\Log;
use Yii;
use yii\base\InvalidConfigException;
use yii\web\Request;
use yii\web\Response;
use yii\base\Exception;

/**
 * Class LogSystem
 * @author funson86 <funson86@gmail.com>
 */
class LogSystem extends \yii\base\Component
{
    public $queue = false;

    public $levels = ['error'];

    public $ignoreCodes = [404];

    /**
     * @param int $code
     * @param null $data
     * @param Request|null $request
     * @throws \yii\base\InvalidConfigException
     */
    public function operation(int $code, $data = null, Request $request = null)
    {
        return $this->create(Log::TYPE_OPERATION, $request, $data, $code);
    }

    /**
     * @param null $data
     * @param Request|null $request
     * @param bool $failed
     * @throws \yii\base\InvalidConfigException
     */
    public function login($data = null, Request $request = null, $failed = false)
    {
        $code = $failed ? Log::CODE_LOGIN_FAILED : Log::CODE_SUCCESS;
        if (!$failed) {
            $user = Yii::$app->user->identity;
            Yii::$app->session->set('oldLastLoginAt', $user->last_login_at);
            $user->last_login_at = time();
            $user->last_login_ip = Yii::$app->request->getRemoteIP();
            $user->save();
        }
        return $this->create(Log::TYPE_LOGIN, $request, null, $code, $data);
    }

    /**
     * @param null $data
     * @param Request|null $request
     * @throws \yii\base\InvalidConfigException
     */
    public function db($data = null, Request $request = null)
    {
        return $this->create(Log::TYPE_DB, $request, $data);
    }

    /**
     * @param Response $response
     * @param Request|null $request
     * @throws \yii\base\InvalidConfigException
     */
    public function error(Response $response, Request $request = null)
    {
        $code = $response->getStatusCode();
        $level = Log::getCodeLevel($code);
        if (!in_array($level, $this->levels) || $code < 400 || in_array($code, $this->ignoreCodes)) {
            return null;
        }

        $data = '';
        $exception = Yii::$app->errorHandler->exception;
        if ($exception instanceof Exception) {
            $data = [
                'name' => $exception->getName(),
                'code' => $exception->getCode(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'message' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
            ];
        }
        $msg = isset($data['message']) ? $data['message'] : '';

        return $this->create(Log::TYPE_ERROR, $request, $data, $code, $msg);
    }

    /**
     * @param int $type
     * @param Request|null $request
     * @param null $data
     * @param int $code
     * @param string $msg
     * @return array|bool
     * @throws InvalidConfigException
     */
    protected function create(int $type = Log::TYPE_LOGIN, Request $request = null, $data = null, $code = Log::CODE_SUCCESS, $msg = '')
    {
        if (!$request) {
            $request = Yii::$app->request;
        }

        $model = new Log();
        $model->id = IdHelper::snowFlakeId();
        $user = Yii::$app->user ?? null;
        if ($user && $user->identity) {
            $model->name = $user->identity->username;
            $model->user_id = $user->id;
            $model->store_id = $user->identity->store_id;
        } elseif (isset($data['username'])) {
            $model->name = $data['username'];
        }

        // 控制台批量修改不记录日志，否则数据库都是控制台修改日志
        if (!$request instanceof Request) {
            return false;
        }

        $model->url = $request instanceof Request ? $request->getUrl() : 'console';
        $model->method = $request instanceof Request ? strtoupper($request->getMethod()) : 'console';
        $model->params = $request instanceof Request ? json_encode($request->getBodyParams()) : 'console';
        $model->user_agent = $request instanceof Request ? $request->getUserAgent() : 'console';
        $model->agent_type = CommonHelper::isMobile() ? Log::AGENT_TYPE_MOBILE : Log::AGENT_TYPE_PC;
        $model->ip = $request instanceof Request ? $request->getRemoteIP() : '';
        $model->ip_info = IpHelper::ip2Location($model->ip);

        if (is_array($data)) {
            $model->data = json_encode($data);
        } else {
            $model->data = $data ?? '';
        }

        $model->cost_time = Yii::getLogger()->getElapsedTime();
        $model->type = $type;
        $model->code = $code;
        $model->msg = $msg ?? '';

        // 插入队列
        if ($this->queue) {
            Yii::$app->queue->push(new LogJob(['model' => $model]));
        } else {
            $this->insert($model);
        }

        return $model->attributes;
    }

    public function insert($model)
    {
        if (!$model->save()) {
            Yii::error($model->errors);
        }
    }

    public function console($command, $code, $msg)
    {
        $model = new Log();
        $model->type = Log::TYPE_CONSOLE;
        $model->name = 'system';
        $model->url = $command;
        $model->code = $code;
        $model->cost_time = Yii::getLogger()->getElapsedTime();
        $model->msg = $msg;
        $model->save();
    }
}
