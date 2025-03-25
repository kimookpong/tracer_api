<?php

namespace app\modules\v1\controllers;

use Yii;
use yii\helpers\Url;
use app\components\TemplateController;

class MainController extends TemplateController
{

    public function actionIndex()
    {
        $this->apiResponse->data = ['db_connect' => Url::toRoute(['db'], true)];
        return $this->ok();
    }
    public function actionDb()
    {
        try {
            $command = Yii::$app->db->createCommand('SELECT 1');
            $result = $command->queryScalar();
            $this->apiResponse->data = $result;
            return $this->ok();
        } catch (\Exception $e) {
            return $this->internalError();
        }
    }
}
