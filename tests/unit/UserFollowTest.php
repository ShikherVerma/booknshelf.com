<?php

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserFollowTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        User::withoutSyncingToSearch(function () {
            $this->userOne = factory(App\User::class)->create();
            $this->userTwo = factory(App\User::class)->create();
        });
    }

    // test that userOne can follow userTwo
    public function testAuthUserCanFollowOtherUser()
    {

        $this->actingAs($this->userOne)
            ->json('POST', '/follows', [
                'id' => $this->userTwo->id,
            ]);
        $this->assertResponseStatus(200);
        $this->seeInDatabase('follows', [
            'follower_id' => $this->userOne->id,
            'followed_id' => $this->userTwo->id,
        ]);
    }

    public function testAuthUserCanUnfollowOtherUser()
    {
        // let's create follow relationship between users
        DB::insert(
            'insert into follows (follower_id, followed_id) values (?, ?)',
            [$this->userOne->id, $this->userTwo->id]
        );
        $this->seeInDatabase('follows', [
            'follower_id' => $this->userOne->id,
            'followed_id' => $this->userTwo->id,
        ]);


        $this->actingAs($this->userOne)
            ->json('DELETE', '/follows/' . $this->userTwo->id);
        $this->assertResponseStatus(200);
        $this->dontSeeInDatabase('follows', [
            'follower_id' => $this->userOne->id,
            'followed_id' => $this->userTwo->id,
        ]);
    }

    public function testAuthUserCantFollowSameUserAgain()
    {
        // let's create follow relationship between users
        DB::insert(
            'insert into follows (follower_id, followed_id) values (?, ?)',
            [$this->userOne->id, $this->userTwo->id]
        );

        $this->seeInDatabase('follows', [
            'follower_id' => $this->userOne->id,
            'followed_id' => $this->userTwo->id,
        ]);

        // trying to follow this user again should fail
        $this->actingAs($this->userOne)
            ->json('POST', '/follows', [
                'id' => $this->userTwo->id,
            ]);

        $this->assertResponseStatus(400);
    }
}
