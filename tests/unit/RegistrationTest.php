<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * @group stripe
 */
class RegistrationTest extends TestCase
{
    use DatabaseTransactions;

//    public function test_users_can_register()
//    {
//        $this->call('POST', '/register', [
//            'name' => 'Tigran Hakobyan',
//            'username' => 'tigran',
//            'password' => 'secret',
//        ]);
//
//
//        $this->seeStatusCode(200);
//
//        $this->seeInDatabase('users', [
//            'username' => 'tigran',
//        ]);
//    }
}