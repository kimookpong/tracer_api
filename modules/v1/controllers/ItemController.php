<?php

namespace app\modules\v1\controllers;

use yii\web\Controller;

class ItemController extends Controller
{
    public function actionIndex()
    {
        return [
            'message' => 'This is the index action of ItemController in v1 module.',
        ];
    }
}
