<?php

namespace frontend\tests\functional;

use common\fixtures\JsonDataFixture;
use common\models\User;
use frontend\tests\FunctionalTester;

class ApiSendJsonCest
{
    protected $apiToken;

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
                'class' => JsonDataFixture::class,
                'dataFile' => '@common/tests/_data/user.php',
            ],
        ];
    }

    public function _before(FunctionalTester $I)
    {
        $user = User::find()->where(['username' => 'api']);
        $this->apiToken = $user->generateApiToken(5);
    }

    public function checkValidLogin(FunctionalTester $I)
    {
        $I->submitForm('#login-form', $this->formParams('erau', 'password_0'));
        $I->see('Logout (erau)', 'form button[type=submit]');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Signup');
    }
}
