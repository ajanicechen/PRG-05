<?php

namespace App\Http\Controllers;

use App\Models\Character;
use http\Env\Response;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    //View all characters
    public function index(){
//        //get data from the character model
        $characters = Character::all();
//        //is same as SELECT * FROM characters

        //pass this data to the character view
        return view('/characters/index', ['characters' => $characters]);
    }

    //[Admin] View list of all characters in table
    public function overview(){

        if(auth()->guest() || auth()->user()->role != 'admin'){
            abort(\Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
        }

        $characters = Character::all();
        return view('/admin/overview',['characters' => $characters]);
    }

    //[admin] edit form
    public function edit($id){

        if(auth()->guest() || auth()->user()->role != 'admin'){
            abort(\Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
        }

        $character = Character::find($id);
        return view('/admin/edit', ['character' => $character]);
    }

    //[admin] add a new character
    public function create(){

        if(auth()->guest() || auth()->user()->role != 'admin'){
            abort(\Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
        }

        return view('admin/addCharacter');
    }

    //[admin] details character
    public function read($id){

        if(auth()->guest() || auth()->user()->role != 'admin'){
            abort(\Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
        }

        $character = Character::find($id);
        return view('/admin/read', ['character' => $character]);
    }

    //[admin] save new character
    public function store(Request $request){

        if(auth()->guest() || auth()->user()->role != 'admin'){
            abort(\Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
        }

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

    //[admin] saves new data of character
    public function update(Request $request, $id){

        if(auth()->guest() || auth()->user()->role != 'admin'){
            abort(\Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
        }

        $character = Character::find($id);
        $character->charName = $request->input('charName');
        $character->charVision = $request->input('charVision');
        $character->charLore = $request->input('charLore');
        $character->charPortrait = $request->input('charPortrait');
        $character->update();
        return redirect()->back()->with('status','Character Updated Succesfully');
    }

    //[admin] delete character
    public function destroy($id){

        if(auth()->guest() || auth()->user()->role != 'admin'){
            abort(\Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
        }

        $character = Character::find($id);
        $character->delete();
        return redirect()->back()->with('status','Character Deleted Successfully');
    }
}
