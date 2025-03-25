<?php

namespace app\modules\v1;

use yii\base\Module as BaseModule;

class Mod extends BaseModule
{
    public function init()
    {
        parent::init();
        // \Yii::$app->set('db', require __DIR__ . '/Connect.php');
    }
}
