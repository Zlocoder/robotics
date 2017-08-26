<?php

namespace admin\models;

class AdminUser extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {
    public static function tableName() {
        return 'AdminUser';
    }

    public function rules() {
        return [
            [['login', 'password'], 'required'],
            ['login', 'string', 'max' => 32],
            ['password', 'string', 'length' => 60],
            ['login', 'unique']
        ];
    }

    public static function findIdentity($id) {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        return null;
    }

    public function getId() {
        return $this->id;
    }

    public function getAuthKey() {
        return null;
    }

    public function validateAuthKey($authKey) {
        return false;
    }


}