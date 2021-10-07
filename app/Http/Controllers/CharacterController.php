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

    public function overview(){
        $characters = Character::all();
        return view('/admin/overview',['characters' => $characters]);
    }

    public function edit($id){
        $character = Character::find($id);
        return view('/admin/edit', ['character' => $character]);
    }

    public function create(){
        return view('admin/addCharacter');
    }

    public function read($id){
        $character = Character::find($id);
        return view('/admin/read', ['character' => $character]);
    }

    public function store(Request $request){
        $character = new Character;
        $character->charName = $request->input('charName');
        $character->charVision = $request->input('charVision');
        $character->charLore = $request->input('charLore');
        $character->charPortrait = $request->input('charPortrait');
        $character->save();
        return redirect()->back()->with('status','Character Added Succesfully');
//        $characters = Character::all();
//        return redirect('/overview');
    }

    public function update(Request $request, $id){
        $character = Character::find($id);
        $character->charName = $request->input('charName');
        $character->charVision = $request->input('charVision');
        $character->charLore = $request->input('charLore');
        $character->charPortrait = $request->input('charPortrait');
        $character->update();
        return redirect()->back()->with('status','Character Updated Succesfully');
    }

    public function destroy($id){
        $character = Character::find($id);
        $character->delete();
        return redirect()->back()->with('status','Character Deleted Successfully');
    }
}
