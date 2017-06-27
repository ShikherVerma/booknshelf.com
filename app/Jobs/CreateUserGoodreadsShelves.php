<?php

namespace App\Jobs;

use App\Repositories\BookRepository;
use App\Repositories\ShelfRepository;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Jobs\SetBookCoverFromGoodreads;


class CreateUserGoodreadsShelves implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $goodreadsShelves;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $goodreadsShelves)
    {
        $this->user = $user;
        $this->goodreadsShelves = $goodreadsShelves;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(BookRepository $bookRepo, ShelfRepository $shelfRepo)
    {

        // let's get the books of each shelf
        $booksByShelves = $shelfRepo->getBooksFromGoodreadsShelves($this->user, $this->goodreadsShelves);
        foreach ($booksByShelves as $shelfName => $shelfBooks) {
            // create a new shelf now
            $shelf = $this->user->shelves()->create([
                'name' => $shelfName,
                'slug' => str_slug($shelfName),
            ]);
            // add all the books to the shelf
            foreach ($shelfBooks as $book) {
                $extractedBook = $bookRepo->extractGoodreadsBookData($book);
                $newBook = $bookRepo->createBookFromGoodreadsData($extractedBook);
                if (!empty($newBook)) {
                    // attach the books to the shelf
                    $shelf->books()->attach($newBook->id);
                }
            }
            dispatch((new UpdateShelfCover($shelf))->onQueue('shelves_cover'));
        }
    }
}
