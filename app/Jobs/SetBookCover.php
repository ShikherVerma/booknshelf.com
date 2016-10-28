<?php

namespace App\Jobs;

use App\Book;
use App\Services\GoogleBooks;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\ImageManager;
use Log;
use Storage;

class SetBookCover implements ShouldQueue
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
    public function handle(GoogleBooks $service, ImageManager $imageManager)
    {
        $images = [];
        // If book does not have an image on Google then ignore.
        if (is_null($this->book->image)) {
            return $this->delete();
        }
        $s3 = Storage::disk('s3');

        // thumbnail
        $thumbnail = $imageManager->make((string)$this->book->image);
        $path = 'book-covers/' . $this->book->google_volume_id . '.png';
        Log::info('Going to save the book image here at this path: '. $path);
        $s3->put($path, (string)$thumbnail->encode());
        $images['image'] = $s3->url($path);

        // large image
        try {
            Log::info('Querying Google Books API for a volume.', ['volume_id' => $this->book->google_volume_id]);
            $volume = $service->getVolume($this->book->google_volume_id);
        } catch (\Google_Service_Exception $e) {
            Log::notice(
                "Could not find any book in Google Books API.",
                ['volume_id' => $this->book->google_volume_id]
            );
            $this->book->forceFill($images)->save();
            return $this->delete();
        }

        $largeImage = $volume['volumeInfo']['imageLinks']['large']
            ?? $volume['volumeInfo']['imageLinks']['medium']
            ?? $volume['volumeInfo']['imageLinks']['extraLarge'];

        if (!empty($largeImage)) {
            // save the original image url just in case we need it in the future
            $images['original_image'] = $largeImage;
            $largeImage = preg_replace("/^http:/i", "https:", $largeImage);
            // create a new image directly from an url and resize it by height
            $coverImage = $imageManager->make((string)$largeImage)->heighten(450);
            $coverImagePath = 'book-large-covers/' . $this->book->google_volume_id . '.png';
            Log::info('Going to save the book cover image here at this path: '. $coverImagePath);
            $s3->put($coverImagePath, (string)$coverImage->encode());
            $images['cover_image'] = $s3->url($coverImagePath);
        }


        $this->book->forceFill($images)->save();

        $this->delete();
    }
}
