<?php

namespace App\Http\Controllers;

use App\Models\Keys;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    
    public function welcome() {
        if (Auth::check())
            return redirect()->route('dashboard');
        $keys = Keys::all();
        $site = Site::all();
        return view('welcome', [
            'keys' => $keys,
            'site' => $site
        ]);
    }

    public function dashboard() {
        $keys = Keys::all();
        $texts = Site::where('color', 0)->get(['id', 'text']);
        $color = Site::where('color', 1)->first('text');
        return view('dashboard', [
            'keys' => $keys,
            'texts' => $texts,
            'color' => $color
        ]);
    }

    public function register() {
        abort(404);
    }

    public function forgotPassword() {
        abort(404);
    }

}
