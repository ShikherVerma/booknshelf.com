<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class NoteTest extends TestCase
{

    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        User::withoutSyncingToSearch(function () {
            $this->user = factory(App\User::class)->create();
        });
    }

    public function test_auth_users_can_create_notes()
    {
        $book = factory(App\Book::class)->create();
        $response = $this->actingAs($this->user)
                ->json('POST', '/api/notes', [
                    'text' => 'This is a note example',
                    'is_private' => true,
                    'book_id' => $book->id,
                ]);

        $this->seeInDatabase('notes', [
            'book_id' => $book->id,
            'user_id' => $this->user->id,
        ]);
    }

}
