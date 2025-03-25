<?php

/**
 * Created by CDTWU
 * User: Hakim Mudor
 * Date: 21/06/2023
 * Time: 14:41
 */


//  เงื่อนไขการใช้งาน roles 
//  '@'     => บังคับ เข้าสู่ระบบ และ บังคับ เลือกสิทธิ์
//  '!'     => บังคับ เข้าสู่ระบบ และ ไม่บังคับ เลือกสิทธิ์
//  '?'     => บังคับ ยังไม่เข้าระบบ
//  ไม่กำหนด roles   => ไม่ตรวจสอบทุกเงื่อนไข

namespace app\components;

use Yii;
use yii\filters\AccessRule;

class UserRule extends AccessRule
{
    protected function matchRole($user)
    {
        if (empty($this->roles)) {
            return true;
        }
        foreach ($this->roles as $role) {
            if ($role === '?') {
                return true;
            } else if ($role === '@') {
                if ($this->isLogin()) {
                    return true;
                }
            } else if ($role === '!') {
                if ($this->isLogin()) {
                    return true;
                }
            }
        }
        return false;
    }

    public function identityRule($user)
    {
        //initial variable
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        $module_id = Yii::$app->session->get('MODULE_ID');

        // check module and priv
        if (empty($module_id)) {
            throw new \yii\web\ForbiddenHttpException(Yii::t('app', 'You did not use system with the correct procedure.'));
        }

        return true;
    }


    public function isLogin()
    {
        return Yii::$app->session->has('Tracer@user');
    }
}
