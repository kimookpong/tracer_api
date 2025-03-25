<?php

namespace app\components;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use Codeception\Util\HttpCode;

class TemplateController extends Controller
{
    protected BaseResponse $apiResponse;
    private String $groupName;
    private String $token;
    private Bool $authorized = true;
    public Bool $sendWithHeader = true;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        unset($behaviors['authenticator']);
        $behaviors['corsFilter'] = [
            'class' => '\yii\filters\Cors',
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['Authorization'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
            ],
        ];

        return $behaviors;
    }


    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        $this->response->format = Response::FORMAT_JSON;
        $this->apiResponse = new BaseResponse();
        $this->groupName = Yii::$app->controller->module->id;

        if (!$this->isAuthorized()) {
            $this->sendWithHeader = true;
        }


        return parent::beforeAction($action);
    }

    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);
        return $this->apiResponse->send($this->sendWithHeader);
    }

    protected function isAuthorized()
    {
        return $this->authorized;
    }

    protected function setAuthorized(Bool $isAutorized): void
    {
        $this->authorized = $isAutorized;
    }


    protected function badGateway()
    {
        $this->apiResponse->setCode(BaseResponse::CODE_BAD_GATEWAY, BaseResponse::MSG_BAD_GATEWAY, HttpCode::BAD_GATEWAY);
        $this->response->setStatusCode(HttpCode::BAD_GATEWAY);

        return false;
    }

    protected function badRequest()
    {
        $this->apiResponse->setCode(BaseResponse::CODE_BAD_REQUEST, BaseResponse::MSG_BAD_REQUEST, HttpCode::BAD_REQUEST);
        $this->response->setStatusCode(HttpCode::BAD_REQUEST);

        return false;
    }

    protected function internalError()
    {
        $this->apiResponse->setCode(BaseResponse::CODE_ERROR, BaseResponse::MSG_UNKNOWN_ERROR, HttpCode::INTERNAL_SERVER_ERROR);
        $this->response->setStatusCode(HttpCode::INTERNAL_SERVER_ERROR);

        return false;
    }
    protected function ok()
    {
        $this->apiResponse->setCode(BaseResponse::CODE_OK, BaseResponse::MSG_OK, HttpCode::OK);
        $this->response->setStatusCode(HttpCode::OK);

        return false;
    }
    protected function notFound()
    {
        $this->apiResponse->setCode(BaseResponse::CODE_NOT_FOUND, BaseResponse::MSG_NO_DATA, HttpCode::NOT_FOUND);
        $this->response->setStatusCode(HttpCode::NOT_FOUND);

        return false;
    }
    protected function created()
    {
        $this->apiResponse->setCode(BaseResponse::CODE_CREATED, BaseResponse::MSG_CREATED, HttpCode::CREATED);
        $this->response->setStatusCode(HttpCode::CREATED);

        return false;
    }
    protected function updated()
    {
        $this->apiResponse->setCode(BaseResponse::CODE_CREATED, BaseResponse::MSG_UPDATED, HttpCode::CREATED);
        $this->response->setStatusCode(HttpCode::CREATED);

        return false;
    }
    protected function unAuthorized()
    {
        $this->apiResponse->setCode(BaseResponse::CODE_UNAUTHORIZED, BaseResponse::MSG_UNAUTHORIZED, HttpCode::UNAUTHORIZED);
        $this->response->setStatusCode(HttpCode::UNAUTHORIZED);

        return false;
    }
    protected function deleted()
    {
        $this->apiResponse->setCode(BaseResponse::CODE_CREATED, BaseResponse::MSG_DELETED, HttpCode::CREATED);
        $this->response->setStatusCode(HttpCode::CREATED);

        return false;
    }
}
