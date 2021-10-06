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

    public function create(){
        return view('characters/addCharacter');
    }

    public function store(Request $request){
        $character = new Character;
        $character->charName = $request->input('charName');
        $character->charVision = $request->input('charVision');
        $character->charLore = $request->input('charLore');
        $character->charPortrait = $request->input('charPortrait');
        $character->save();
//        return redirect()->with('status','Character Added Succesfully');
        $characters = Character::all();
        return redirect('/characters');
    }
}
