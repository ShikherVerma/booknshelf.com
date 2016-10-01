<?php

namespace App\Jobs;

use App\Book;
use App\Repositories\BookRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\ImageManager;
use App\Services\GoogleBooks;
use Log;
use Storage;

class SetBookCover extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

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
    public function handle(GoogleBooks $service, ImageManager $imageManager)
    {
        // If book does not have an image on Google then ignore.
        if (is_null($this->book->image)) {
            return $this->delete();
        }
        $s3 = Storage::disk('s3');
        // Query Google for the large image
        $volume = $service->getVolume($this->book->google_volume_id);
        $largeImage = $volume['volumeInfo']['imageLinks']['large'];
        $largeImage = preg_replace("/^http:/i", "https:", $largeImage);
        // create a new image directly from an url
        $thumbnail = $imageManager->make((string)$this->book->image);
        echo $thumbnail;
        $coverImage = $imageManager->make((string)$largeImage);

        // thumbnail
        $path = 'book-covers/' . $this->book->google_volume_id . '.png';
        Log::info('Going to save the book image here at this path: '. $path);
        $s3->put($path, (string)$thumbnail->encode());

        // large cover image
        $coverImagePath = 'book-large-covers/' . $this->book->google_volume_id . '.png';
        Log::info('Going to save the book cover image here at this path: '. $coverImagePath);
        $s3->put($coverImagePath, (string)$coverImage->encode());


        $this->book->forceFill([
            'image' => $s3->url($path),
            'cover_image' => $s3->url($coverImagePath),
        ])->save();

        $this->delete();
    }
}
