<?php

namespace console\controllers;

use common\models\User;
use Yii;
use yii\console\Controller;

class CronController extends Controller
{
    public function actionGetToken($login, $password)
    {
        echo $login;
        echo $password;

        $user = User::findByUsername($login);
        if ($user->validatePassword($password)) {
            echo 'Ваш токен доступа к API: ' . $user->generateApiToken();
        } else {
            echo 'Неверный логин или пароль';
        }
    }

}
