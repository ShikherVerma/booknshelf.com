<?php


class LoginCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
    }

    public function userCannotLoginWithoutPassword(FunctionalTester $I)
    {
        $I->wantTo('not be able to login without password');

        $I->amOnPage("/");

        $I->click('LOGIN');
        $I->fillField('username', 'milesaaa');
        $I->fillField('password', '');

        $I->click('login');

        $I->seeCurrentUrlEquals('/login');

    }
}
