<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Trip;
use App\User;

class TripTest extends TestCase {

    use DatabaseTransactions;


    public function test_users_redirect_to_login_if_they_try_to_view_trip_lists_without_logging_in()
    {
        $this->visit('/trips')->seePageIs('/login');
    }

    public function test_auth_users_can_create_trip()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
            ->visit('/trip/create')
            ->type('Rochester, NY', 'from')
            ->type('New York, New York', 'to')
            ->type('12/12/2015', 'start_date')
            ->select('passenger', 'role')
            ->type('this is a test other info', 'other_info')
            ->press('Create');

        $this->seeInDatabase('trips', ['to' => 'New York, New York', 'from' => 'Rochester, NY']);

    }

    public function test_trip_should_have_all_required_fields_when_its_created()
    {
        // `from` field is missing which a required field
        $faker = Faker\Factory::create();
        $user = factory(App\User::class)->create();
        $trip = [
            'type'            => 'long',
            'to'              => $faker->streetAddress,
            'start_date'      => $faker->date('m/d/Y'),
            'return_date'     => $faker->date('m/d/Y'),
            'role'            => 'driver',
            'offers'          => 'coffee',
            'other_info'      => $faker->text(100),
            'available_seats' => $faker->biasedNumberBetween(1, 10)
        ];
        $this->actingAs($user)
            ->post('/trip/store', $trip)
            ->seeStatusCode(500);
    }

    public function test_users_cant_delete_tasks_of_other_users()
    {
        $this->withoutMiddleware();

        $userOne = factory(User::class)->create();
        $userTwo = factory(User::class)->create();

        $userOne->trips()->save($tripOne = factory(Trip::class)->create(['user_id' => $userOne->id]));
        $userTwo->trips()->save($tripTwo = factory(Trip::class)->create(['user_id' => $userTwo->id]));

        $this->actingAs($userOne)
            ->delete('/trip/' . $tripTwo->id)
            ->assertResponseStatus(403);
    }

    public function test_users_can_delete_their_trips()
    {
        // do not run VerifyCsrfToken middleware
        $this->withoutMiddleware();

        $user = factory(User::class)->create();
        $user->trips()->save($trip = factory(Trip::class)->create(['user_id' => $user->id]));

        $this->actingAs($user)
            ->delete('/trip/' . $trip->id)
            # redirect
            ->assertResponseStatus(302);
    }

    /** @test */
    public function test_users_cant_edit_trips_of_other_users()
    {
    }
}
