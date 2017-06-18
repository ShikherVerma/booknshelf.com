<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class LikeTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(App\User::class)->create([
            'username' => 'tigran_tester',
        ]);
        $this->book = factory(App\Book::class)->create();
    }

    public function testUsersCanLikeBook()
    {
        $this->actingAs($this->user);

        $this->json('POST', '/likes/books/' . $this->book->id . '/toggle');

        $this->assertResponseStatus(200);

        $this->seeInDatabase('likes', [
            'user_id' => $this->user->id,
            'book_id' => $this->book->id,
        ]);
    }

    public function testUsersCanDislikeBook()
    {
        $this->actingAs($this->user);

        // if the user already like this book then we should dislike it
        $this->like = factory(App\Like::class)->create([
            'user_id' => $this->user->id,
            'book_id' => $this->book->id,
        ]);

        $this->json('POST', '/likes/books/' . $this->book->id . '/toggle');

        $this->assertResponseStatus(200);

        $this->dontSeeInDatabase('likes', [
            'user_id' => $this->user->id,
            'book_id' => $this->book->id,
        ]);
    }
}
