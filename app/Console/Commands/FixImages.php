<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Log;

class FixImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'images:fix-image-urls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change all images url to be only the name of the file';

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
        // Topics
        $topics = DB::table('topics')
                            ->whereNotNull('cover_photo')
                            ->get();

        Log::info("The total count of topics.", ['count' => $topics->count()]);
        $topics->each(function ($topic) {
            $end = array_slice(explode('/', $topic->cover_photo), -1)[0];
            DB::table('topics')
                    ->where('id', $topic->id)
                    ->update(['cover_photo' => $end]);
        });

        // Books
        $books = DB::table('books')
                            ->whereNotNull('cover_image')
                            ->get();
        Log::info("The total count of books.", ['count' => $books->count()]);
        $books->each(function ($book) {
            $end = array_slice(explode('/', $book->cover_image), -1)[0];
            DB::table('books')
                    ->where('id', $book->id)
                    ->update(['cover_image' => $end, 'original_image' => $end, 'image' => $end]);
        });

        // Shelves
        $shelves = DB::table('shelves')
                            ->whereNotNull('cover')
                            ->get();
        Log::info("The total count of shelves.", ['count' => $shelves->count()]);
        $shelves->each(function ($shelf) {
            $end = array_slice(explode('/', $shelf->cover), -1)[0];
            DB::table('shelves')
                    ->where('id', $shelf->id)
                    ->update(['cover' => $end]);
        });

        // Users
        $profiles = DB::table('users')
                            ->whereNotNull('avatar')
                            ->get();
        Log::info("The total count of profiles.", ['count' => $profiles->count()]);
        $profiles->each(function ($profile) {
            $end = array_slice(explode('/', $profile->avatar), -1)[0];
            DB::table('users')
                    ->where('id', $profile->id)
                    ->update(['avatar' => $end]);
        });
    }
}
