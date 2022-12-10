<?php

namespace frontend\controllers;

use common\models\JsonData;
use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\Json;
use yii\web\Response;

class ApiController extends \yii\web\Controller
{
    /**
     * @return array
     */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        // Аутентификация перед запросом к API
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];
        return $behaviors;
    }

    /**
     * Получение json через GET или POST запрос и дальнейшее сохранение в базу
     * @return array
     */
    public function actionSendJson(): array
    {
        $recordId = null;
        // Устанавливаем начальные метки времени и использованной памяти
        $timeStart = microtime(true);
        $memoryStart = memory_get_usage();
        Yii::$app->response->format = Response::FORMAT_JSON;

        // Получаем данные из запроса
        $data = Yii::$app->request->post();
        if (empty($data)) {
            $data = Json::decode(Yii::$app->request->get('data'));
        }
        if (!empty($data)) {
            // Сохраняем модель
            $jsonObj = new JsonData();
            $jsonObj->data = $data;
            if ($jsonObj->save()) {
                $recordId = $jsonObj->id;
            }
        }
        return [
            'id' => $recordId,
            'time' => microtime(true) - $timeStart,
            'memory' => memory_get_usage() - $memoryStart,
        ];
    }

}
