<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'changeLanguage');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::withCount('posts')->get();

        return view('home', compact('users'));
    }

    public function changeLanguage(Request $request)
    {
        $lang = $request->language;
        if ($lang != 'en' && $lang != 'vi') {
            $lang = config('app.locale');
        }
        Session::put('language', $lang);

        return redirect()->back();
    }
}
