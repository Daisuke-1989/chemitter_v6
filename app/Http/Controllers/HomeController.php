<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;

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
    public function index(Tweet $tweet)
    {
        $user = auth()->user();
        $timelines = $tweet->paginate(50);
        // dd($timelines);

        return view('home', [
            'user'      => $user,
            'timelines' => $timelines
        ]);
    }
}
