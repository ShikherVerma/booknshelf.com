<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Storage;

use App\Http\Requests;
use App\User;

class SettingsController extends Controller
{
    protected $images;

    public function __construct(ImageManager $images)
    {
        $this->middleware('auth');
        $this->images = $images;
    }

    public function show()
    {
        return view('settings');
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$request->user()->id,
            'username' => 'required|max:255|unique:users,username,'.$request->user()->id,
            'about' => 'max:255',
        ]);

        // if email changed then
        // Event::fire(new UserEmailChanged($user));
        $request->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'about' => $request->about,
        ]);
        return response()->json($request->user()->toArray());
    }

    public function updatePhoto(Request $request)
    {

        $this->validate($request, [
            'photo' => 'required|image|max:4000',
        ]);
        $data = $request->all();
        $user = $request->user();

        $file = $data['photo'];

        $path = $file->hashName('profiles');
        $disk = Storage::disk('public');

        $disk->put(
            $path, $this->formatImage($file)
        );

        $user->forceFill([
            'avatar' => $disk->url($path),
        ])->save();

        return response()->json($request->user()->toArray());
    }

    /**
     * Resize an image instance for the given file.
     *
     * @param  \SplFileInfo  $file
     * @return \Intervention\Image\Image
     */
    protected function formatImage($file)
    {
        return (string) $this->images->make($file->path())
                            ->fit(300)->encode();
    }

}
