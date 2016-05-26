<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Shelf;
use App\User;

class ShelfTest extends TestCase {

    use DatabaseTransactions;


    public function test_users_redirect_to_login_if_they_try_to_view_shelves_without_logging_in()
    {
        $this->visit('/shelves')->seePageIs('/login');
    }

    public function test_auth_users_can_create_shelves()
    {
        $user = factory(App\User::class)->create();
        $response = $this->actingAs($user)
                ->call('POST', '/shelf/create', [
                'name' => 'Bookshelf Name Test',
                'description' => 'Bookshelf description',
        ]);
        $this->assertEquals(200, $response->status());
        $this->seeInDatabase('shelves',
            ['name' => 'Bookshelf Name Test', 'description' => 'Bookshelf description']);
    }

    public function test_shelf_should_have_all_required_fields_when_its_created()
    {
        // `name` field is required
        $user = factory(App\User::class)->create();
        $response = $this->actingAs($user)
                ->call('POST', '/shelf/create', [
                'description' => 'Bookshelf description',
        ]);
        // TODO: Find a better way to test this.
        $this->assertRedirectedTo('/');
    }

    // public function test_users_cant_delete_tasks_of_other_users()
    // {
    //     $this->withoutMiddleware();

    //     $userOne = factory(User::class)->create();
    //     $userTwo = factory(User::class)->create();

    //     $userOne->trips()->save($tripOne = factory(Trip::class)->create(['user_id' => $userOne->id]));
    //     $userTwo->trips()->save($tripTwo = factory(Trip::class)->create(['user_id' => $userTwo->id]));

    //     $this->actingAs($userOne)
    //         ->delete('/trip/' . $tripTwo->id)
    //         ->assertResponseStatus(403);
    // }

    // public function test_users_can_delete_their_trips()
    // {
    //     // do not run VerifyCsrfToken middleware
    //     $this->withoutMiddleware();

    //     $user = factory(User::class)->create();
    //     $user->trips()->save($trip = factory(Trip::class)->create(['user_id' => $user->id]));

    //     $this->actingAs($user)
    //         ->delete('/trip/' . $trip->id)
    //         # redirect
    //         ->assertResponseStatus(302);
    // }

    /** @test */
    public function test_users_cant_edit_trips_of_other_users()
    {
    }
}
