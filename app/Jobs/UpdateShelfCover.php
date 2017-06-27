<?php

namespace App\Jobs;

use App\Shelf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\ImageManager;
use Log;
use Storage;

class UpdateShelfCover implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $shelf;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Shelf $shelf)
    {
        $this->shelf = $shelf;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ImageManager $imageManager)
    {
        $books = $this->shelf->books()
            ->whereNotNull('cover_image')
            ->orderBy('created_at', 'desc')->take(2)->get()->toArray();

        Log::info($books);
        $covers = [];
        foreach ($books as $book) {
            $covers[] = $book['cover_image'];
        }

        $canvas = $imageManager->canvas(300, 300);
        $s3 = Storage::disk('s3');

        if (count($covers) === 1) {
            $url = asset('/img/backgrounds/default-shelf-cover.jpg');
            $left = $imageManager->make($url)->fit(145, 300);
            // if it's a goodreads book then use a different url
            if (stripos(strtolower($covers[0]), 'gr-assets.com') !== false) {
                $right = $imageManager->make($covers[0])->fit(145, 300);
            } else {
                $right = $imageManager->make($s3->url('book-covers/' . $covers[0]))->fit(145, 300);
            }
            // create canvas and insert parts
            $canvas->insert($left, 'top-left');
            $canvas->insert($right, 'top-right');
        } elseif (count($covers) === 2) {
            // if it's a goodreads book then use a different url
            if (stripos(strtolower($covers[0]), 'gr-assets.com') !== false) {
                $left = $imageManager->make($covers[0])->fit(145, 300);
            } else {
                $left = $imageManager->make($s3->url('book-covers/' . $covers[0]))->fit(145, 300);
            }

            // if it's a goodreads book then use a different url
            if (stripos(strtolower($covers[1]), 'gr-assets.com') !== false) {
                $right = $imageManager->make($covers[1])->fit(145, 300);
            } else {
                $right = $imageManager->make($s3->url('book-covers/' . $covers[1]))->fit(145, 300);
            }
            // create canvas and insert parts
            $canvas->insert($left, 'top-left');
            $canvas->insert($right, 'top-right');
        }

        $shelfCoverName = $this->shelf->id . '-' . strtotime("now") . '.png';
        $path = 'shelf-covers/' . $shelfCoverName;
        Log::info('Showing the path of the file: '. $path);

        $s3->put($path, (string)$canvas->encode());

        // save the cover url in db
        $this->shelf->forceFill([
            'cover' => $shelfCoverName,
        ])->save();

        // delete the job
        $this->delete();
    }
}
