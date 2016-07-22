<?php

namespace App\Jobs;

use App\Jobs\Job;
use Hash;
use Log;
use Storage;
use App\Shelf;
use Intervention\Image\ImageManager;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateShelfCover extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

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
        $books = $this->shelf->books()->whereNotNull('image')
            ->orderBy('created_at', 'desc')->take(1)->get()->toArray();
        $covers = [];
        foreach ($books as $book) {
            $covers[] = $book['image'];
        }

        if(empty($covers)) return;

        $s3 = Storage::disk('s3');
        // create a new image directly from an url
        // TODO: What if the book does not have a cover? It's empty.
        $img = $imageManager->make($covers[0]);
        // paste another image
        $img->blur(40);
        $path = Hash::make($this->shelf->id) . '.png';
        Log::info('Showing the path of the file: '. $path);

        $s3->put($path, (string)$img->fit(300)->encode());

        // save the cover url in db
        $this->shelf->forceFill([
            'cover' => $s3->url($path),
        ])->save();

        // TODO:
        // 1. Get the top three book covers from the shelf (3 most recent ones)
        // 2. Add them all together as a single image
        // 3. blur them 50%
        // 4. store the image in s3
        // 5. store the image s3 path in the database
    }
}
