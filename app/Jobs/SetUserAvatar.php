<?php

namespace App\Jobs;

use App\User;
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
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ImageManager $imageManager)
    {
        if(is_null($this->user->avatar)) {
            return $this->delete();
        }

        $s3 = Storage::disk('s3');
        $img = (string) $imageManager->make($this->user->avatar)->fit(300)->encode();
        $path = 'profiles/' . $this->user->username . '.png';

        $s3->put($path, $img);
        $this->user->forceFill([
            'avatar' => $s3->url($path),
        ])->save();

        $this->delete();
    }
}
