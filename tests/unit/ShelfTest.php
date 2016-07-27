<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Shelf;
use App\User;

class ShelfTest extends TestCase
{

    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(App\User::class)->create();
    }

    public function test_auth_users_can_create_shelves()
    {
        $response = $this->actingAs($this->user)
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
        $this->actingAs($this->user);
        $this->json('POST', '/shelves', [
                'description' => 'Bookshelf description',
        ]);
        // `name` field is required so the response is not OK
        $this->assertResponseStatus(422);
    }

    public function test_shelf_has_correct_slug()
    {
        $this->actingAs($this->user);
        $this->json('POST', '/shelves', [
                'name' => 'Bookshelf Name Test With Slug'
            ])->seeJson([
                'slug' => 'bookshelf-name-test-with-slug'
            ]);
    }

    public function test_user_can_successfully_update_a_shelf()
    {
        $this->actingAs($this->user);

        $shelf = factory(App\Shelf::class)->create([
            'name' => 'Bookshelf Name is not Changed',
            'user_id' => $this->user->id
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
        $this->actingAs($this->user);

        $shelf = factory(App\Shelf::class)->create([
            'name' => 'Bookshelf Name',
            'user_id' => $this->user->id
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
        $this->actingAs($this->user);

        $shelf = factory(App\Shelf::class)->create([
            'name' => 'Bookshelf test name',
            'user_id' => $this->user->id
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
        $userOne = $this->user;
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

    public function test_users_cant_edit_shelves_of_other_users()
    {
        $userOne = $this->user;
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
        $shelfOne = factory(App\Shelf::class)->create([
            'name' => 'Bookshelf Name 1',
            'slug' => 'bookshelf-name-1',
            'user_id' => $this->user->id,
        ]);

        $response = $this->actingAs($this->user)
                ->call('POST', '/shelves', [
                'name' => 'Bookshelf Name 1',
                'description' => 'Bookshelf description',
        ]);

        $this->assertResponseStatus(403);
    }

    public function test_users_can_store_books_to_shelves()
    {
        $this->withoutJobs();

        $shelf = factory(App\Shelf::class)->create([
            'name' => 'Bookshelf Name 1',
            'slug' => 'bookshelf-name-1',
            'user_id' => $this->user->id,
            'cover' => 'http://books.google.com/books?id=gt7EQgH8-b4C&dq=thin+air&hl=&as_pt=BOOKS&source=gbs_api',
        ]);
        $book = factory(App\Book::class)->create();
        $response = $this->actingAs($this->user)
                ->call('POST', '/shelves/'.$shelf->id.'/books', [
                'id' => $book->id,
        ]);

         $this->expectsJobs(\App\Jobs\UpdateShelfCover::class);
        
        $this->assertResponseOk();
        $this->seeInDatabase('book_shelf', [
            'shelf_id' => $shelf->id,
            'book_id' => $book->id
        ]);
    }

    public function test_users_can_remove_a_book_from_shelf()
    {
        $this->withoutJobs();

        $shelf = factory(App\Shelf::class)->create([
            'name' => 'Bookshelf Name 1',
            'slug' => 'bookshelf-name-1',
            'user_id' => $this->user->id,
            'cover' => 'http://books.google.com/books?id=gt7EQgH8-b4C&dq=thin+air&hl=&as_pt=BOOKS&source=gbs_api',
        ]);
        $book = factory(App\Book::class)->create();
        $this->actingAs($this->user)
            ->call('POST', '/shelves/'.$shelf->id.'/books', [
            'id' => $book->id,
        ]);

        $this->expectsJobs(\App\Jobs\UpdateShelfCover::class);

        $this->assertResponseOk();
        $this->seeInDatabase('book_shelf', [
            'shelf_id' => $shelf->id,
            'book_id' => $book->id
        ]);
        $this->actingAs($this->user)
            ->call('DELETE', '/shelves/'.$shelf->id.'/books', [
            'id' => $book->id,
        ]);
        $this->dontSeeInDatabase('book_shelf', [
            'shelf_id' => $shelf->id,
            'book_id' => $book->id
        ]);
    }
}
