<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\follower;
use App\Models\post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $followerlist = follower::where('userID','=', $user->id )->pluck('folowerID');

        $followerlist[] = auth()->id();


        $posts = post::whereIn('owner', $followerlist)->latest()->paginate(5);
 
        return view('home', compact('posts', 'followerlist'));
    }
}
