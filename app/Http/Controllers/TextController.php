<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class TextController extends Controller
{
    
    public function update(Request $request) {
        $request->validate([
            'id' => ['required'],
            'text' => ['required', 'max:255']
        ]);

        Site::where('id', $request->id)->update([
            'text' => $request->text
        ]);

        return redirect()->back();
    }

}
