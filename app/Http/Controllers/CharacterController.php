<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function index(){
//        //get data from the character model
        $characters = Character::all();
//        //is same as SELECT * FROM characters

        //pass this data to the character view
        return view('/characters/index', ['characters' => $characters]);
    }
}
