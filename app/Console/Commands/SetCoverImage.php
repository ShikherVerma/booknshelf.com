<?php

namespace App\Console\Commands;

use App\Book;
use App\Jobs\SetBookCover;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Log;

class SetCoverImage extends Command
{
    use DispatchesJobs;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'books:set-cover-image';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set the large cover image for all books';

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
        $books = Book::where('cover_image', null)->get();

        $books->each(function ($book) {
            Log::info('Creating a new job for the book with a title '. $book['title']);
            dispatch(new SetBookCover($book));
        });
    }
}
