<?php

namespace App\Console\Commands;

use App\Jobs\UpdateShelfCover;
use App\Repositories\ShelfRepository;
use App\User;
use Illuminate\Console\Command;

class UpdateOurShelfCovers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shelves:update-our-shelf-covers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the covers of the shelves that belong to Booknshelf.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(ShelfRepository $shelfRepository)
    {
        $user = User::where('username', 'booknshelf')->first();
        if (is_null($user)) {
            echo "No username Booknshelf found. \n";
            return;
        };
        $shelves = collect($user->shelves()->get());
        $shelves->each(function ($shelf) {
            // Send a job so the cover of the shelf will be updated.
            dispatch((new UpdateShelfCover($shelf))->onQueue('shelves_cover'));
        });
    }
}
