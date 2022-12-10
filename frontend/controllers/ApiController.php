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

    public function actionSendJson()
    {
        $recordId = null;
        $timeStart = microtime(true);
        $memoryStart = memory_get_usage();
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = Yii::$app->request->post();
        if (empty($data)) {
            $data = Json::decode(Yii::$app->request->get('data'));
        }
        if (!empty($data)) {
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
