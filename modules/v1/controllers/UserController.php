<?php

namespace app\modules\v1\controllers;

use Yii;
use app\components\TemplateController;

class UserController extends TemplateController
{
    public function actionIndex()
    {
        $id = Yii::$app->request->get('id');
        try {
            if ($id) {
                $command = Yii::$app->db->createCommand("SELECT * FROM user WHERE id = $id");
                $result = $command->queryOne();
            } else {
                $command = Yii::$app->db->createCommand("SELECT * FROM user");
                $result = $command->queryAll();
            }
            $this->apiResponse->data = $result;
            return $this->ok();
        } catch (\Exception $e) {
            return $this->internalError();
        }
    }

    public function actionCreate()
    {
        try {
            $username = "admin";
            $password = Yii::$app->security->generatePasswordHash('admin');
            echo $password;
            exit;
            $command = Yii::$app->db->createCommand("INSERT INTO user (username, password) VALUES ('$username', '$password')");
            $command->execute();
            return $this->ok();
        } catch (\Exception $e) {
            return $this->internalError();
        }
    }
}
