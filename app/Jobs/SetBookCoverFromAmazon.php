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
        // let's store the original image for future use
        $images['original_image'] = $this->book->cover_image;

        $coverImage = $imageManager->make((string)$this->book->cover_image)->heighten(450);
        $path = 'book-covers/' . $this->book->asin . '-' . strtotime('now') . '.png';
        Log::info('Going to save the book image here at this path: '. $path);
        $s3->put($path, (string)$coverImage->encode());
        $images['cover_image'] = $s3->url($path);

        // save the new urls
        $this->book->forceFill($images)->save();

        $this->delete();
    }
}
