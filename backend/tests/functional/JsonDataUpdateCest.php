<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\JsonDataFixture;
use common\fixtures\UserFixture;
use common\models\User;

/**
 * Class LoginCest
 */
class JsonDataUpdateCest
{
    protected $fromId = 'jsonDataEditForm';
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
        $I->amOnRoute('json-data/edit', ['id' => 1]);
        $I->see("Logout ({$user->username})");
    }

    protected function formParams($data)
    {
        return [
            "$this->fromId[data]" => $data,
        ];
    }


    /**
     * @param FunctionalTester $I
     */
    protected function jsonDataEditExist(FunctionalTester $I)
    {
        $I->amOnRoute('json-data/edit', ['id' => 1]);
        $I->see('Update Json Data: 1');
    }

    /**
     * @param FunctionalTester $I
     */
    public function jsonDataEditNotExist(FunctionalTester $I)
    {
        $I->amOnRoute('json-data/edit', ['id' => 2]);
        $I->see("Not Found (#404)");
    }

    /**
     * @param FunctionalTester $I
     */
    public function jsonDataEditCheckWrongFormatData(FunctionalTester $I)
    {
        $this->jsonDataEditExist($I);
        $I->submitForm("#{$this->fromId}", $this->formParams('123'));
        $I->see('Неверный формат');
    }

    /**
     * @param FunctionalTester $I
     */
    public function jsonDataEditCheckEmptyData(FunctionalTester $I)
    {
        $this->jsonDataEditExist($I);
        $I->submitForm("#{$this->fromId}", $this->formParams(''));
        $I->see('Data cannot be blank.');
    }

    /**
     * @param FunctionalTester $I
     */
    public function jsonDataEditCheckCorrectData(FunctionalTester $I)
    {
        $this->jsonDataEditExist($I);
        $I->submitForm("#{$this->fromId}", $this->formParams('{"active":true,"formed":2016,"members":[{"age":29,"name":"Molecule Man","powers":["Radiation resistance","Turning tiny","Radiation blast"],"secretIdentity":"Dan Jukes"},{"age":39,"name":"Madame Uppercut","powers":["Million tonne punch","Damage resistance","Superhuman reflexes"],"secretIdentity":"Jane Wilson"},{"age":1000000,"name":"Eternal Flame","powers":["Immortality","Heat Immunity","Inferno","Teleportation","Interdimensional travel"],"secretIdentity":"Unknown"}],"homeTown":"Metro City","squadName":"Super hero squad","secretBase":"Super tower"}'));
        $I->see('Data cannot be blank.');
    }

}
