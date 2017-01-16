<?php

use Laracasts\TestDummy\Factory as TestDummy;

// all public methods declared in helper class will be available in $I

class FunctionalTester extends \Codeception\Actor
{
    use _generated\FunctionalTesterActions;

    /**
     * Prepare Booknshelf account, and log in.
     */
    public function signIn()
    {
        $name = 'Tester name';
        $username = 'foobar';
        $password = 'password';

        $this->haveAnAccount(compact('name', 'username', 'password'));

        $this->amOnPage('/login');
        $this->fillField('username', $username);
        $this->fillField('password', 'password');
        $this->click('login');
    }

    /**
     * Create a Booknshelf user account in the database.
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
}
