<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class TopicTest extends TestCase
{

    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        User::withoutSyncingToSearch(function () {
            $this->user = factory(App\User::class)->create();
        });
    }

    public function testAuthUsersCanFollowTopics()
    {
        // create the topic first
        $topic = factory(App\Topic::class)->create([
            'name' => 'TestName',
            'slug' => 'testname',
            'description' => 'The best books about test',
        ]);

        $this->actingAs($this->user)
            ->json('POST', '/topics/follow', [
                'id' => $topic->id,
            ]);
        $this->assertResponseStatus(200);
        $this->seeInDatabase('topic_user', [
            'user_id' => $this->user->id,
            'topic_id' => $topic->id,
        ]);
    }

    public function testAuthUsersCanUnfollowTopics()
    {
        // create the topic first
        $topic = factory(App\Topic::class)->create([
            'name' => 'TestName2',
            'slug' => 'testname2',
            'description' => 'The best books about test2',
        ]);
        DB::insert('insert into topic_user (topic_id, user_id) values (?, ?)', [$topic->id, $this->user->id]);

        $this->actingAs($this->user)
            ->json('POST', '/topics/unfollow', [
                'id' => $topic->id,
            ]);
        $this->assertResponseStatus(200);
        $this->dontSeeInDatabase('topic_user', [
            'user_id' => $this->user->id,
            'topic_id' => $topic->id,
        ]);
    }

    public function testAuthUsersCantFollowNonExistingTopic()
    {
        $this->actingAs($this->user)
            ->json('POST', '/topics/follow', [
                'id' => 1234,
            ]);
        $this->assertResponseStatus(422);
    }
}
