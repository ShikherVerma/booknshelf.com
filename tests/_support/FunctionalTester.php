<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/

use Laracasts\TestDummy\Factory as TestDummy;

class FunctionalTester extends \Codeception\Actor
{
    use _generated\FunctionalTesterActions;

   /**
    * Define custom actions here
    */
    /**
     * Prepare Larabook account, and log in.
     */
    public function signIn(FunctionalTester $I)
    {
        $name = 'Tester name';
        $username = 'foobar';
        $password = bcrypt('foopassword');

        $this->haveAnAccount(compact('name', 'username','password'));

        $I->amOnPage('/login');
        $I->fillField('username', $username);
        $I->fillField('password', 'foopassword');
        $I->click('login');

    }

    /**
     * Create a Larabook user account in the database.
     *
     * @param array $overrides
     * @return mixed
     */
    public function haveAnAccount($overrides = [])
    {
        return $this->haveUser($overrides);
    }

    /**
     * Insert a dummy record into a database table.
     *
     * @param $model
     * @param array $overrides
     * @return mixed
     */
    public function haveUser($overrides = [])
    {
        $user = TestDummy::create('App\User', $overrides);
        return $user;
    }

    public function createShelf(FunctionalTester $I, $name)
    {
        $I->click("CREATE");
        $I->fillField('name', $name);
        $I->click('Create');
    }
}
