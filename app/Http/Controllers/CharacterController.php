<?php

namespace App\Http\Controllers;

use App\Models\Characters;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function index(){
        //get data from the character model
        $title = 'Characters';
        $characters = Characters::all();
        //is same as SELECT * FROM characters

        //pass this data to the character view
        return view('/characters/index',compact('title', 'characters'));
    }
}
