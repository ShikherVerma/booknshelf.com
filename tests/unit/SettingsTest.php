<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class SettingsTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(App\User::class)->create([
            'username' => 'some_tester_username'
        ]);
        $this->user2 = factory(App\User::class)->create([
            'username' => 'testusername'
        ]);
    }

    public function test_users_can_update_their_settings()
    {
        $this->actingAs($this->user);

        $this->json('PUT', '/settings/profile', [
                'username' => $this->user->username,
                'name' => 'Changed User Test',
                'email' => 'changedtester@gmail.com'
            ])->seeJson([
                'name' => 'Changed User Test',
                'email' => 'changedtester@gmail.com',
            ]);

        $this->assertResponseStatus(200);

        $this->seeInDatabase('users', [
            'name' => 'Changed User Test',
            'email' => 'changedtester@gmail.com',
        ]);
    }

    public function test_settings_update_username_always_required()
    {
        $this->actingAs($this->user);

        $this->json('PUT', '/settings/profile', [
                'name' => 'Changed User Test',
                'email' => 'changedtester@gmail.com'
        ]);
        // username is required
        $this->assertResponseStatus(422);
    }

    public function test_username_should_always_be_unique()
    {
        $this->actingAs($this->user);

        $this->json('PUT', '/settings/profile', [
                'username' => $this->user2->username,
                'name' => 'Changed User Test',
                'email' => 'changedtester2@gmail.com'
             ])->seeJson([
                 'username' => ["The username has already been taken."],
            ]);;
        $this->assertResponseStatus(422);
    }

    public function test_username_should_always_be_letters_numbers_and_underscores()
    {
        $this->actingAs($this->user);

        $this->json('PUT', '/settings/profile', [
                'username' => 'wrong-username#',
                'name' => 'Changed User Test',
                'email' => 'changedtester2@gmail.com'
             ])->seeJson([
                 'username' => ["Only use letters, numbers and underscores for username."],
            ]);;
        $this->assertResponseStatus(422);
    }
}
