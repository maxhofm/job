<?php

namespace common\fixtures;

use common\models\JsonData;
use yii\test\ActiveFixture;

class JsonDataFixture extends ActiveFixture
{
    public $modelClass = 'common\models\JsonData';
    public $dataFile = '@common/tests/_data/json_data.php';
}
