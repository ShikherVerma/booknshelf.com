<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Shelf;
use App\User;

class ShelfTest extends TestCase
{

    use DatabaseTransactions;

    public function test_users_redirect_to_login_if_they_try_to_view_shelves_without_logging_in()
    {
        $this->visit('/shelves')->seePageIs('/login');
    }

    public function test_auth_users_can_create_shelves()
    {
        $user = factory(App\User::class)->create();
        $response = $this->actingAs($user)
                ->call('POST', '/shelves', [
                'name' => 'Bookshelf Name Test',
                'description' => 'Bookshelf description',
        ]);
        $this->assertEquals(200, $response->status());
        $this->seeInDatabase('shelves', [
            'name' => 'Bookshelf Name Test',
            'description' => 'Bookshelf description',
        ]);
    }

    public function test_shelf_should_have_all_required_fields_when_its_created()
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        $this->json('POST', '/shelves', [
                'description' => 'Bookshelf description',
        ]);
        // `name` field is required so the response is not OK
        $this->assertResponseStatus(422);
    }

    public function test_shelf_has_correct_slug()
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user);
        $this->json('POST', '/shelves', [
                'name' => 'Bookshelf Name Test With Slug'
            ])->seeJson([
                'slug' => 'bookshelf-name-test-with-slug'
            ]);
    }

    public function test_user_can_successfully_update_a_shelf()
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user);

        $shelf = factory(App\Shelf::class)->create([
            'name' => 'Bookshelf Name is not Changed',
            'user_id' => $user->id
        ]);
        $this->json('PUT', '/shelves/'.$shelf->id, [
                'name' => 'Bookshelf Name is Changed'
        ]);
        $this->assertResponseOk();
        $this->seeInDatabase('shelves', [
            'name' => 'Bookshelf Name is Changed',
        ]);
    }

    public function test_user_can_successfully_delete_a_shelf()
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user);

        $shelf = factory(App\Shelf::class)->create([
            'name' => 'Bookshelf Name',
            'user_id' => $user->id
        ]);
        $this->json('DELETE', '/shelves/'.$shelf->id);
        $this->assertResponseOk();
        $this->dontSeeInDatabase('shelves', [
            'name' => 'Bookshelf Name',
        ]);
    }

    public function test_when_changing_shelf_name_slug_is_also_changed()
    {
        $user = factory(App\User::class)->create();
        $this->actingAs($user);

        $shelf = factory(App\Shelf::class)->create([
            'name' => 'Bookshelf test name',
            'user_id' => $user->id
        ]);
        $this->json('PUT', '/shelves/'.$shelf->id, [
                'name' => 'Bookshelf test name changed'
        ]);
        $this->assertResponseOk();
        $this->seeInDatabase('shelves', [
            'slug' => str_slug('Bookshelf test name changed'),
        ]);
    }

    public function test_users_cant_delete_shelves_of_other_users()
    {
        $userOne = factory(User::class)->create();
        $userTwo = factory(User::class)->create();

        $shelfOne = factory(App\Shelf::class)->create([
            'name' => 'Bookshelf Name 1',
            'user_id' => $userOne->id
        ]);
        $shelfTwo = factory(App\Shelf::class)->create([
            'name' => 'Bookshelf Name 1',
            'user_id' => $userTwo->id
        ]);

        $this->actingAs($userOne);
        $this->json('DELETE', '/shelves/'.$shelfTwo->id);

        $this->assertResponseStatus(404);
    }

    public function test_users_cant_edit_trips_of_other_users()
    {
        $userOne = factory(User::class)->create();
        $userTwo = factory(User::class)->create();

        $shelfOne = factory(App\Shelf::class)->create([
            'name' => 'Bookshelf Name 1',
            'user_id' => $userOne->id
        ]);
        $shelfTwo = factory(App\Shelf::class)->create([
            'name' => 'Bookshelf Name 1',
            'user_id' => $userTwo->id
        ]);

        $this->actingAs($userOne);
        $this->json('PUT', '/shelves/'.$shelfTwo->id, [
                'name' => 'Trying to change Bookshelf Name',
                'description' => 'Some description'
        ]);

        $this->assertResponseStatus(404);
    }

    public function test_users_cant_have_two_shelves_with_the_same_name()
    {
        $user = factory(User::class)->create();
        $shelfOne = factory(App\Shelf::class)->create([
            'name' => 'Bookshelf Name 1',
            'slug' => 'bookshelf-name-1',
            'user_id' => $user->id,
        ]);


        $response = $this->actingAs($user)
                ->call('POST', '/shelves', [
                'name' => 'Bookshelf Name 1',
                'description' => 'Bookshelf description',
        ]);

        $this->assertResponseStatus(403);
    }

    public function test_users_can_store_books_to_shelves()
    {
    }
}
