<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    
    public function update(Request $request) {
        $request->validate([
            'id' => ['required']
        ]);
        
        if ($request->hasFile('image') && ($request->id == 1 || $request->id == 2)) {
            $image = $request->file('image');
            $path = public_path() . '/images/';
    
            $changedImage = ($request->id == 1) ? 'creator.png' : 'logo_white.png';
    
            if (file_exists($path . $changedImage))
                unlink($path . $changedImage);
            $image->move($path, $changedImage);
        }

        return redirect()->back();
    }

}
