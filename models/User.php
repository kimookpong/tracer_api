<?php

namespace app\models;

use Yii;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    const STATUS_ACTIVE = 1;
    const STATUS_IN_ACTIVE = 0;

    public $ID;
    public $USERNAME;
    public $STUDENT_ID;
    public $USER_LANG;
    public $FULLNAME_TH;
    public $FULLNAME_EN;
    public $AVATAR_PATH;
    public $PASSWORD_HASH;

    public $GENDER;
    public $FACULTYID;
    public $FACULTYNAME_TH;
    public $FACULTYNAME_EN;
    public $PROGRAMID;
    public $PROGRAMNAME_TH;
    public $PROGRAMNAME_EN;
    public $RELIGIONID;
    public $RELIGIONNAME_TH;
    public $RELIGIONNAME_EN;
    public $STUDENTYEAR;
    public $ROLE;
    public $STATUS;

    private static $std =
    [
        'ID' => null,
        'USERNAME' => null,
        'FULLNAME_TH' => null,
    ];

    public static function getModel()
    {
        return new static(self::$std);
    }

    public static function findIdentity($id)
    {
        $userSession = Yii::$app->session->get('Tracer@user');
        if (!empty($userSession) && $userSession->ID == ($id))
            return Yii::$app->session->get('Tracer@user');
        return null;
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::getModel();
    }

    public function getId()
    {
        return $this->ID;
    }

    public function getAuthKey()
    {
        return $this->PASSWORD_HASH;
    }

    public function validateAuthKey($authKey)
    {
        return $this->PASSWORD_HASH === $authKey;
    }

    public function validatePassword($password)
    {
        return $this->PASSWORD_HASH === $password;
    }
}
