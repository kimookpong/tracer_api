<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\User;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'ruleConfig' => [
                    'class' => \app\components\UserRule::className(),
                ],
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                ],
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionError()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $exception = Yii::$app->errorHandler->exception;
        if ($exception instanceof NotFoundHttpException) {
            return [
                //'name' => 'Not Found',
                'message' => 'This page does not found.',
                'status' => 404,
            ];
        } else {
            return $this->asJson([
                //'name' => $exception ? $exception->name : 'Error',
                'message' => $exception ? $exception->getMessage() : 'An unexpected error occurred in v1.',
                'status' => $exception ? $exception->statusCode : 500,
            ]);
        }
    }

    public function adminMode($username, $password)
    {
        $adminUser = [
            "USERNAME" => "admin",
            "FULLNAME_TH" => "ผู้ดูแลระบบ",
            "FULLNAME_EN" => "Administrator",
            "PASSWORD" => "admin"
        ];
        if ($username == $adminUser["USERNAME"] && $password == $adminUser["PASSWORD"]) {
            return $adminUser;
        }
        return false;
    }


    public function actionLogin()
    {


        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->session->destroy();
            $model->username = strtolower($model->username);
            $adminUser = $this->adminMode($model->username, $model->password);

            if ($adminUser) {
                Yii::$app->session->set('Tracer@user', $model);
                return $this->goHome();
            }
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
            'myInfo' => Yii::$app->request->userAgent
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->session->remove('Tracer@user');
        return $this->goHome();
    }
}
