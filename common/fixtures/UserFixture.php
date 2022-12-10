<?php

namespace common\fixtures;

use common\models\User;
use yii\test\ActiveFixture;

class UserFixture extends ActiveFixture
{
    public $modelClass = 'common\models\User';
    public $dataFile = '@common/tests/_data/user.php';
}
