<?php

namespace App\Console\Commands;

use App\Book;
use Illuminate\Console\Command;

class ConvertBookCoversHttps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'books:https';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert all boook covers from http to https';

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
        $this->info('Started the command.');
        $books = Book::all();
        foreach ($books as $book) {
            $image = $book->image;
            if(!is_null($image)) {
                $image = preg_replace("/^http:/i", "https:", $image);
                $book->forceFill([
                    'image' => $image,
                ])->save();
            }
        }
        $this->info('Finished the command.');
    }
}
