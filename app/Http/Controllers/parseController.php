<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class parseController extends Controller
{
    
    public function get() {
        $blockHeight = 5;
        $blockInfo = file_get_contents('https://blockchain.info/block-height/'.$blockHeight.'?format=json');
        $blockInfo = json_decode($blockInfo);
        dd($blockInfo);
    }

}
