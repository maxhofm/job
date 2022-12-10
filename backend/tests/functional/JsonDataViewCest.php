<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\JsonDataFixture;
use common\fixtures\UserFixture;
use common\models\User;

/**
 * Class LoginCest
 */
class JsonDataViewCest
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
        $I->amOnRoute('json-data/view?id=1');
        $I->see("Logout ({$user->username})");
    }


    /**
     * @param FunctionalTester $I
     */
    public function jsonDataViewExist(FunctionalTester $I)
    {
        $I->amOnRoute('json-data/view', ['id' => 1]);
        $I->see('Update');
        $I->see('Create');
    }

    /**
     * @param FunctionalTester $I
     */
    public function jsonDataViewNotExist(FunctionalTester $I)
    {
        $I->amOnRoute('json-data/view', ['id' => 2]);
        $I->see("Not Found (#404)");
        $I->see("The requested page does not exist.s");
        $I->cantSee('Update');
        $I->cantSee('Create');
    }
}
