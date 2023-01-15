<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    
    public function update(Request $request) {
        $request->validate([
            'color' => ['required', 'max:255']
        ]);

        Site::where('color', 1)->update([
            'text' => $request->color
        ]);

        return redirect()->back();
    }

}
