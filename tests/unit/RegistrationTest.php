<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Jobs\SetUserAvatar;
use App\Events\UserRegistered;

/**
 * @group stripe
 */
class RegistrationTest extends TestCase
{
    use DatabaseTransactions;

    public function testUsersCanRegisterViaUsername()
    {
        $this->expectsJobs(SetUserAvatar::class);
        $this->expectsEvents(UserRegistered::class);

        $this->visit('/register')
             ->type('Tigran', 'name')
             ->type('tigran143tester', 'username')
            ->type('tigran@test.com', 'email')
             ->type('password', 'password')
             ->press('JOIN')
             ->seePageIs('/');
    }
}