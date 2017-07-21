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

    public function test_cant_create_note_without_text()
    {
        $book = factory(App\Book::class)->create();
        $response = $this->actingAs($this->user)
                ->json('POST', '/api/notes', [
                    'is_private' => true,
                    'book_id' => $book->id,
                ]);

        $this->assertResponseStatus(422);
        $this->dontSeeInDatabase('notes', [
            'book_id' => $book->id,
            'user_id' => $this->user->id,
        ]);
    }

    public function test_auth_user_can_delete_her_note()
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

        // DELETE
        $note = App\Note::where('book_id', $book->id)->first();
        $response = $this->actingAs($this->user)
                ->json('DELETE', "/api/notes/{$note->id}");

        $this->dontSeeInDatabase('notes', [
            'id' => $note->id,
        ]);
    }

    public function test_auth_user_cant_delete_other_persons_note()
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

        // DELETE
        $note = App\Note::where('book_id', $book->id)->first();

        $user2 = factory(App\User::class)->create();

        $response = $this->actingAs($user2)
                ->json('DELETE', "/api/notes/{$note->id}");

        // $this->assertResponseStatus(422);

        $this->seeInDatabase('notes', [
            'id' => $note->id,
        ]);
    }

}
