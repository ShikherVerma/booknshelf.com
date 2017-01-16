<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group stripe
 */
class RegistrationTest extends TestCase
{
    use DatabaseTransactions;

    public function testUsersCanRegisterViaUsername()
    {
        $this->visit('/register')
             ->type('Tigran', 'name')
             ->type('tigranjan', 'username')
             ->type('password', 'password')
             ->press('Join')
             ->seePageIs('/welcome');
    }
}