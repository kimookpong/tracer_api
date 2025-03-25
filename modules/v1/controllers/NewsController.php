<?php

namespace app\modules\v1\controllers;

use Yii;
use app\components\TemplateController;

class NewsController extends TemplateController
{
    public function actionIndex()
    {
        $id = Yii::$app->request->get('id');
        try {
            if ($id) {
                $command = Yii::$app->db->createCommand("SELECT * FROM news WHERE id = $id");
                $result = $command->queryOne();
            } else {
                $command = Yii::$app->db->createCommand("SELECT * FROM news");
                $result = $command->queryAll();
            }
            $this->apiResponse->data = $result;
            return $this->ok();
        } catch (\Exception $e) {
            return $this->internalError();
        }
    }

    public function actionFeed()
    {
        try {
            $command = Yii::$app->db->createCommand("SELECT * FROM news ORDER BY date DESC LIMIT 5");
            $result = $command->queryAll();
            $this->apiResponse->data = $result;
            return $this->ok();
        } catch (\Exception $e) {
            return $this->internalError();
        }
    }
}
