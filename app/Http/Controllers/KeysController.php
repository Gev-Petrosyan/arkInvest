<?php

namespace App\Http\Controllers;

use App\Models\Keys;
use Illuminate\Http\Request;

class KeysController extends Controller
{
    
    public function store(Request $request) {
        $request->validate([
            'title' => ['required', 'max:255'],
            'address' => ['required', 'max:255']
        ]);
        Keys::create([
            'title' => $request->title,
            'address' => $request->address
        ]);
        return redirect()->back();
    }

    public function delete($id) {
        $key = Keys::find($id);
        if (!empty($key)) $key->delete();
        return redirect()->back();
    }

    public function update(Request $request) {
        $request->validate([
            'id' => ['required'],
            'title' => ['required', 'max:255'],
            'address' => ['required', 'max:255']
        ]);
        Keys::where('id', $request->id)->update([
            'title' => $request->title,
            'address' => $request->address
        ]);
        return redirect()->back();
    }

}
