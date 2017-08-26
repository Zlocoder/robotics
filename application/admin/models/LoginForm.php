<?php

namespace admin\models;

class LoginForm extends \yii\base\Model {
    public $login;
    public $password;

    public function rules() {
        return [
            [['login', 'password'], 'required'],
            ['login', 'string', 'max' => 32],
            ['password', 'string', 'max' => 32],
        ];
    }

    public function process() {
        if ($this->validate()) {
            if ($adminUser = AdminUser::findOne(['login' => $this->login])) {
                if (\Yii::$app->security->validatePassword($this->password, $adminUser->password)) {
                    return \Yii::$app->admin->login($adminUser);
                }
            }

            $this->addError('login', 'Wrong login or password');
        }

        return false;
    }
}