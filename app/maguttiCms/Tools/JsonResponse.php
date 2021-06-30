<?php namespace App\maguttiCms\Tools;
/**
 * Class JsonResponseTrait
 *
 *
 */

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\Response;

trait JsonResponseTrait
{

    protected bool $error = false;
    protected string $error_code = '';
    protected $msg = '';
    protected string $status = "KO";
    protected $data = null;
    protected $meta = null;
    protected string $last_update = '';
    protected string $httpStatus = "200";
    protected bool $enableLog = true;

    public static function bootJsonResponseTrait()
    {
        static::created(function ($item) {
            // Index the item
        });
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    public function errorCode($code)
    {
        return $this->error_code=$code;
    }

    /**
     * @param mixed $error
     */
    public function setError($error)
    {
        $this->error = $error;
        return;
    }

    /**
     * @param mixed $msg
     * @return JsonResponseTrait
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @param string $status
     * @return JsonResponseTrait
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param array $data
     * @return JsonResponseTrait
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param null $meta
     * @return JsonResponseTrait
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;
        return $this;
    }

    public function getMeta()
    {
        return $this->meta;
    }


    /**
     * @param string $httpStatus
     * @return JsonResponseTrait
     */
    public function setHttpStatus($httpStatus)
    {
        $this->httpStatus = $httpStatus;
        return $this;
    }

    /**
     * @return string
     */
    public function getHttpStatus()
    {
        return $this->httpStatus;
    }

    /*
    |--------------------------------------------------------------------------
    | Response  Handler shorcuts
    |--------------------------------------------------------------------------
    */

    /**
     * @param string $message
     * @return $this
     */
    public function responseSuccess($message = '')
    {
        $this->setStatus('OK');
        if ($message) $this->setMsg($message);
        return $this;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function responseWithError($message = '',$code)
    {
        $this->setStatus('KO');
        $this->setHttpStatus(422);
        $this->setError(true);
        $this->errorCode($code);
        $this->errorLogger($message);
        if ($message) $this->setMsg($message);
        return $this;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function responseNotFound($message = '', $code)
    {
        $this->setHttpStatus(Response::HTTP_BAD_REQUEST);
        $message = ($message) ?: __('api.errors.item_not_found');
        $code ?? ErrorCodes::DataNotFound;
        $this->responseWithError($message,$code);
        return $this;
    }

    /**
     * @return $this
     */
    public function responseWithInvalidData()
    {
        $this->responseWithError(__('api.errors.invalid_data'));
        return $this;
    }

    /**
     * Return the  json response
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiResponse()
    {
        $result = [];
        $result['status'] = $this->getStatus();
        $result['error'] = $this->getError();
        $result['error_code'] = $this->error_code;
        $result['msg'] = $this->getMsg();
        $result['server_time'] = date("Y-m-d H:i:s");
        if ($this->getMeta() != '') {
            $result['meta'] = $this->getMeta();
        }
        $result['data'] = $this->getData();
        return response()->json($result, $this->getHttpStatus());
    }


    public function errorLogger($message = '')
    {
        if ($this->isEnableLog()) {
            $message .= $this->getMsg();
            Log::error("Api [" . Request::fullUrl() . "] " . $message . ':' . print_r(Request::all(), TRUE));
        }
    }

    /**
     * @param bool $enableLog
     * @return JsonResponseTrait
     */
    public function setEnableLog($enableLog)
    {
        $this->enableLog = $enableLog;
        return $this;
    }

    /**
     * @return bool
     */
    public function isEnableLog()
    {
        return $this->enableLog;
    }
}
