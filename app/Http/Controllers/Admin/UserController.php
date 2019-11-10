<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendUserEmailPost;
use App\Mail\UserEmail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $users = User::adminFilter($request)->orderBy('id', 'desc')->paginate();

        return view('admin.user.index', compact('users'));
    }

    public function emailCreate(User $user)
    {
        return view('admin.email.create', compact('user'));
    }

    public function emailSend(SendUserEmailPost $request, User $user)
    {
        Mail::to($user->email)->send(
            new UserEmail($request)
        );

        return redirect(route('admin.user.email.create', $user->id))->with('status', 'Email Sent');
    }
}
