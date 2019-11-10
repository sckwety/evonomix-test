<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $photos = Photo::adminFilter($request)->orderBy('publish_date', 'desc')->paginate();

        return view('admin.photo.index', compact('photos'));
    }
}
