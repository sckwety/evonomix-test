<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $photos = Photo::published()->orderBy('publish_date', 'desc')->paginate();

        return view('home', compact('photos'));
    }
}
