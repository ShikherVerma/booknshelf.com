<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class AuthTest extends TestCase
{

    use DatabaseTransactions;

    public function test_a_user_may_register_and_login()
    {
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
        $response = $this->call('POST', '/register', [
                'name' => 'JohnSnow',
                'username' => 'john.snow',
                'password' => 'password',
        ]);
        // $this->assertEquals(409, $response->status());
        $this->dontSeeInDatabase('users', ['name' => 'JohnSnow']);
    }

    protected function login($user = null)
    {
        $user = $user ?: factory(App\User::class)->create([
            'password' => bcrypt('password'),
            'username' => 'this_is_a_test_username'
        ]);

        return $this->visit('login')
            ->type($user->username, 'username')
            ->type('password', 'password')
            ->press('Log in');
    }

    public function test_a_user_may_login()
    {
        $this->login()->seePageIs('/');
    }
}
