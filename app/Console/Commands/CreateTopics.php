<?php

namespace App\Console\Commands;

use App\Shelf;
use App\Topic;
use App\User;
use Illuminate\Console\Command;

class CreateTopics extends Command
{
    protected $user = null;
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
    public function __construct(User $user)
    {
        $this->user = $user;
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
            [
                'Leadership',
                'Learn to become a better leader. Imrpove your leadership skills.',
                asset('/img/topics/gwe0dlvd9e0-benjamin-child.jpg'),
            ],
            [
                'Software Engineering',
                'I want to become a software engineer. What\'re the best books to get started with?',
                asset('/img/topics/5ntkpxqt54y-sai-kiran-anagani.jpg'),
            ],
            [
                'Personal Finance',
                'I have $X, what should I do with it? How should I handle my finances?',
                asset('/img/topics/6y6onwbkk-o-chris-li.jpg'),
            ],
            [
                'Startups',
                'Learn about startups and how to start your own venture.',
                asset('/img/topics/dtdlvpy-vvq-lee-campbell.jpg'),
            ],
            [
                'Travel',
                'Everyone loves travel. Read the books that will inspire you!',
                asset('/img/topics/vgoiy1gzzyg-atlas-green.jpg'),
            ],
            [
                'Cooking',
                'Learn how to cook a delicious food. Yummy yummy!',
                asset('/img/topics/tuh95zfdzn4-mike-petrucci.jpg'),
            ],
            [
                'Audiobooks',
                'Discover great audiobooks in this topic.',
                asset('/img/topics/66jmudijdtw-alphacolor-13.jpg'),
            ],
            [
                'Photography',
                'Find the most essential photography books.',
                asset('/img/topics/alex-holyoake-157978.jpg'),
            ],
            [
                'Science & Technology',
                'Find the bestseller books in Science & Technology.',
                asset('/img/topics/nasa-63029.jpg'),
            ],
            [
                'Computer Science',
                'What are some of the best books on computer science?',
                asset('/img/topics/sabri-tuzcu-182689.jpg'),
            ],
            [
                'Physics',
                'Discover the most popular books on Physics.',
                asset('/img/topics/3411957501_0930090028_z.jpg'),
            ],
            [
                'Machine Learning & Data Science',
                'Read how Artificial Intelligence (AI) provides computers the ability to learn!',
                asset('/img/topics/AI.jpg'),
            ],
            [
                'History',
                'Read and learn the study of the past!',
                asset('/img/topics/les-anderson-167377.jpg'),
            ],
            [
                'Philosophy',
                'The study of general and fundamental problems concerning existence, knowledge and values.',
                asset('/img/topics/david-marcu-114194.jpg'),
            ],
            [
                'Self-help',
                'Books that can help you to live a happier and more successful life.',
                asset('/img/topics/jenn-richardson-113007.jpg'),
            ],
            [
                'Science Fiction',
                'Best science fiction books to read.',
                asset('/img/topics/joel-filipe-193766.jpg'),
            ],            [
                'Romance',
                '',
                asset('/img/topics/everton-vila-140207.jpg'),
            ],
        ]);


        $this->user = User::where('username', 'topic')->firstOrFail();
        $allTopicNames->each(function ($tuple) {
            Topic::updateOrCreate([
                'name' => $tuple[0],
                'description' => $tuple[1],
                'cover_photo' => $tuple[2],
            ]);

            $shelf = new Shelf;
            $shelf->forceFill([
                'name' => $tuple[0],
                'description' => $tuple[1],
                'slug' => str_slug($tuple[0]),
                'cover' => $tuple[2],
            ]);
            $exists = $this->user->shelves()->where('slug', $shelf->slug)->exists();

            if (!$exists) {
                $this->user->shelves()->save($shelf);
                echo "Created {$tuple[0]} topic \n";
            }
        });
        echo "Done \n";
    }
}
