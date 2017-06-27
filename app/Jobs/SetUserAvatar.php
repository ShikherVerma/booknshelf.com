<?php

namespace App\Jobs;

use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Intervention\Image\ImageManager;
use Storage;

class SetUserAvatar implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $color;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->color = collect(['#00A888', '#FFDD57', '#1C51A6', '#B86BFF', '#E44A66', '#33D6C6'])->random();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ImageManager $imageManager)
    {
        $s3 = Storage::disk('s3');
        // Setup the defaul avatar
        if (is_null($this->user->avatar)) {
            // create empty canvas with background color
            $image = $imageManager->canvas(300, 200, '#FFFFFF');
            // draw an empty circle with 5px border
            $image->circle(150, 150, 100, function ($draw) {
                $draw->background($this->color);
            });
            $img = (string)$image->fit(300)->encode();
        } elseif (isset($this->user->twitter_user_id) || isset($this->user->facebook_user_id)) {
            // $s3->url('profiles/' . $this->user->avatar)
            $img = (string)$imageManager->make($this->user->avatar)->encode();
            // it's goodreads
        } else {
            $img = (string)$imageManager->make($s3->url('profiles/' . $this->user->avatar))->encode();
        }

        $imageName = Carbon::now()->timestamp . '-' . $this->user->username . '.png';
        $path = 'profiles/' . $imageName;


        $s3->put($path, $img);
        $this->user->forceFill([
            'avatar' => $imageName,
        ])->save();

        $this->delete();
    }
}
