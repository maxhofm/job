<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\JsonDataFixture;
use common\fixtures\UserFixture;
use common\models\User;

/**
 * Class LoginCest
 */
class JsonDataIndexCest
{
    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => '@common/tests/_data/user.php',
            ],
            'json-data' => [
                'class' => JsonDataFixture::class,
                'dataFile' => '@common/tests/_data/json_data.php'
            ]
        ];
    }

    public function _before(FunctionalTester $I)
    {
        $user = User::findByUsername('api');
        $I->amLoggedInAs($user);
        $I->amOnRoute('json-data/index');
        $I->see("Logout ({$user->username})");
    }


    /**
     * @param FunctionalTester $I
     */
    public function jsonDataIndex(FunctionalTester $I)
    {
        $I->see('Json Data');
        $I->seeLink('', '/json-data/view?id=1');
        $I->seeLink('', '/json-data/update?id=1');
        $I->seeLink('', '/json-data/delete?id=1');
    }
}
