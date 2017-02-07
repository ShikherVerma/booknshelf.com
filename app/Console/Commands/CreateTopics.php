<?php

namespace App\Console\Commands;

use App\Topic;
use Illuminate\Console\Command;

class CreateTopics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'topics:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the Booknshelf topics';

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
    public function handle()
    {
        // name, desc, cover photo
        $allTopicNames = collect([
            ['Personal Finance', 'This is a desc for personal finance'],
            ['Leadership', 'This is a desc for leadership'],
            ['Interior Design', 'This is a desc for Interior Design. Here we go how is it going?'],
            ['Programming', 'This is a desc for programming']
        ]);
        $allTopicNames->each(function ($tuple) {
            echo "Creating/Updating {$tuple[0]} topic \n";
            Topic::create([
                'name' => $tuple[0],
                'description' => $tuple[1],
                'cover_photo' => 'https://source.unsplash.com/user/erondu/200x200'
            ]);
        });
        echo "Done \n";
    }
}
