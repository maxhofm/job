<?php

namespace console\controllers;

use common\models\User;
use Yii;
use yii\console\Controller;

class CronController extends Controller
{
    public function actionGetToken($login, $password)
    {
        $user = User::findByUsername($login);
        if ($user->validatePassword($password)) {
            $token = $user->generateApiToken();
            if (!empty($token) && $user->save()) {
                echo 'Ваш токен доступа к API: ' . $token;
            } else {
                echo 'Не удалось создать токен для пользователя. Обратитесь к администратору';
            }
        } else {
            echo 'Неверный логин или пароль';
        }
    }

}
