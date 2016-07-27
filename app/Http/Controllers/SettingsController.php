<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Storage;

class SettingsController extends Controller
{
    protected $images;

    public function __construct(ImageManager $images)
    {
        $this->middleware('auth');
        $this->images = $images;
    }

    public function show(Request $request)
    {
        return view('settings',[
            'user' => $request->user(),
        ]);
    }

    public function updateProfile(UpdateUserRequest $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'email|max:255|unique:users,email,'.$request->user()->id,
            'about' => 'max:255',
        ]);

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
        $s3 = Storage::disk('s3');

        $s3->put(
            $path, $this->formatImage($file)
        );

        $user->forceFill([
            'avatar' => $s3->url($path),
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
