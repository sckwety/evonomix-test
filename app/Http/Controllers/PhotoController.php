<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhotoPost;
use App\Http\Requests\UpdatePhotoPost;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $photos = auth()->user()->photos()->filter($request)->orderBy('id', 'desc')->paginate();

        if ($photos->isEmpty()) {
            return redirect(route('photos.create'));
        }

        return view('photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('photos.save');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePhotoPost  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePhotoPost $request)
    {
        $data = $request->validated();

        $photoPath = Storage::putFile($this->getPhotoFolderPath(), $request->file('photo'));

        $data += [
            'photo_path' => $photoPath,
            'user_id' => auth()->id()
        ];

        Photo::create($data);

        return redirect(route('photos.index'))->with('status', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        abort_if($photo->hasOtherUser(), 404);

        $photoUrl = null;
        if (Storage::exists($photo->photo_path)) {
            $photoUrl = Storage::url($photo->photo_path);
        }

        return view('photos.save', compact('photo', 'photoUrl'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePhotoPost  $request
     * @param  Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePhotoPost $request, Photo $photo)
    {
        abort_if($photo->hasOtherUser(), 404);

        $data = $request->validated();
        $data += ['user_id' => auth()->id()];

        $file = $request->file('photo');
        if ($file) {
            Storage::delete($photo->photo_path);
            $photoPath = Storage::putFile($this->getPhotoFolderPath(), $request->file('photo'));
            $data += [
                'photo_path' => $photoPath,
            ];
        }

        $photo->update($data);

        return redirect(route('photos.index'))->with('status', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Photo $photo
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Photo $photo)
    {
        abort_if($photo->hasOtherUser(), 404);

        Storage::delete($photo->photo_path);
        $photo->delete();

        return redirect(route('photos.index'))->with('status', 'success');
    }

    /**
     * @return string
     */
    private function getPhotoFolderPath()
    {
        return 'public/photos/' . auth()->id();
    }

    /**
     * @param $photoName
     * @return string
     */
    private function getPhotoPath($photoName)
    {
        return $this->getPhotoFolderPath() . '/' . $photoName;
    }
}
