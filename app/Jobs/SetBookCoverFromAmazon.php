<?php

namespace App\Jobs;

use App\Book;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\ImageManager;
use Log;
use Illuminate\Support\Facades\Storage;

class SetBookCoverFromAmazon implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $book;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ImageManager $imageManager)
    {
        if (is_null($this->book->cover_image)) {
            return $this->delete();
        }

        $images = [];
        $s3 = Storage::disk('s3');


        $image = $imageManager->make((string)$this->book->cover_image);
        $imageName= $this->book->asin . '-' . strtotime('now') . '.png';
        $path = 'book-covers/' . $imageName;
        Log::info('Going to save the book image here at this path: '. $path);
        $s3->put($path, (string)$image->encode());

        $s3Path = $s3->url($path);

        $images['original_image'] = $imageName;
        $images['cover_image'] = $imageName;

        // save the new urls
        $this->book->forceFill($images)->save();

        $this->delete();
    }
}
