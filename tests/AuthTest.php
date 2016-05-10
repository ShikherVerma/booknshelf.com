<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class AuthTest extends TestCase
{

    use DatabaseTransactions;

    public function test_a_user_may_register_and_can_verify_the_email()
    {
        $response = $this->call('POST', '/register', [
                'name' => 'JohnSnow',
                'email' => 'john.snow@gmail.com',
                'password' => 'password',
        ]);
        $this->assertEquals(302, $response->status());
        $this->seeInDatabase('users', ['name' => 'JohnSnow', 'is_verified' => false]);
        $user = User::whereName('JohnSnow')->first();
        $this->visit("register/confirm/{$user->verify_token}")
            ->see('You are now confirmed. Thanks so much!')
            ->seeInDatabase('users', ['name' => 'JohnSnow', 'is_verified' => true]);
    }

    protected function login($user = null)
    {
        $user = $user ?: factory(App\User::class)->create(
            ['password' => bcrypt('password')]
        );

        return $this->visit('login')
            ->type($user->email, 'email')
            ->type('password', 'password')
            ->press('Log in');
    }

    public function test_a_user_may_login()
    {
        $this->login()->seePageIs('/');
    }
}
