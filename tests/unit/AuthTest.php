<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Jobs\SetUserAvatar;
use App\Events\UserRegistered;


class AuthTest extends TestCase
{

    use DatabaseTransactions;

    public function test_a_user_may_register_and_login()
    {
        $this->expectsJobs(SetUserAvatar::class);
        $this->expectsEvents(UserRegistered::class);
        $response = $this->call('POST', '/register', [
                'name' => 'JohnSnow',
                'username' => 'john_snow',
                'password' => 'password',
        ]);
        $this->assertEquals(302, $response->status());
        $this->seeInDatabase('users', [
            'name' => 'JohnSnow',
            'username' => 'john_snow',
        ]);
    }

    // letters, numbers and underscores only
    public function test_a_user_can_use_only_valid_username()
    {
        $this->doesntExpectJobs(SetUserAvatar::class);
        $this->doesntExpectEvents(UserRegistered::class);
        $this->call('POST', '/register', [
                'name' => 'JohnSnow',
                'username' => 'john.snow',
                'password' => 'password',
        ]);
        $this->dontSeeInDatabase('users', ['name' => 'JohnSnow']);
    }

    public function testUserCantUseUsernameThatAlreadyExists()
    {
        $this->doesntExpectJobs(SetUserAvatar::class);
        $this->doesntExpectEvents(UserRegistered::class);
        factory(App\User::class)->create([
            'username' => 'some_tester_username'
        ]);
        $this->call('POST', '/register', [
                'name' => 'JohnSnow143',
                'username' => 'some_tester_username',
                'password' => 'password143',
        ]);
        $this->dontSeeInDatabase('users', ['name' => 'JohnSnow143']);
    }

    protected function login($user = null)
    {
        $user = $user ?: factory(App\User::class)->create([
            'password' => bcrypt('password'),
            'username' => 'this_is_a_test_username'
        ]);

        $response = $this->call('POST', '/login', [
            'username' =>'this_is_a_test_username',
            'password' => 'password'
        ]);

        $this->assertEquals(302, $response->status());
    }

    public function test_a_user_may_login()
    {
        $this->login();
    }
}
