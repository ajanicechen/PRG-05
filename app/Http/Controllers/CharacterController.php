<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Character_Vision;
use App\Models\Favorite;
use App\Models\User;
use App\Models\Vision;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CharacterController extends Controller
{
    //load all characters in index
    public function index(){
        //if searched, results only
        if(request('search')){
            $search = request('search');
            $characters = Character::join('visions','characters.vision_id','=', 'visions.id')
                ->where('visions.name', 'like', "%$search%" )
                ->orWhere('characters.name','like', "%$search%")
                ->orwhere('characters.lore', 'like', "%$search%")
                ->get([
                    'characters.name',
                    'characters.lore',
                    'characters.vision_id',
                    'characters.status',
                    'characters.portrait'
                ]);
        }
        //if filtered, results only
        elseif (request('filter')){
            $filter = request('filter');
            $characters = Character::join('visions','characters.vision_id','=', 'visions.id')
                ->where('visions.name', 'like', "%$filter%" )
                ->get([
                    'characters.name',
                    'characters.lore',
                    'characters.vision_id',
                    'characters.status',
                    'characters.portrait'
                ]);
        }
        //loads all characters when there is no search or filter
        else{
            $characters = Character::all();
        }
        return view('/characters/index', compact('characters'));
    }

    //[Admin] View list of all characters in table
    public function overview(){
        //if user is guest OR user is not admin
        if(auth()->guest() || auth()->user()->role != 'admin'){
            //redirect to home page
            return redirect('/');
        }
        //search
        if(request('search')){
            //last added > first added
            $search = request('search');
            $characters = Character::join('visions','characters.vision_id','=', 'visions.id')
                ->where('visions.name', 'like', "%$search%" )
                ->orWhere('characters.name','like', "%$search%")
                ->orwhere('characters.lore', 'like', "%$search%")
                ->get([
                    'characters.id',
                    'characters.name',
                    'characters.lore',
                    'characters.vision_id',
                    'characters.status',
                    'characters.portrait'
                ]);
        }
        //filter
        elseif (request('filter')){
            $filter = request('filter');
            $characters = Character::join('visions','characters.vision_id','=', 'visions.id')
                ->where('visions.name', 'like', "%$filter%" )
                ->get([
                    'characters.name',
                    'characters.lore',
                    'characters.vision_id',
                    'characters.status',
                    'characters.portrait'
                ]);
        }
        else {
            $characters = Character::all();
        }
        return view('/admin/overview', compact('characters'));

    }

    //[admin] edit form
    public function edit($id){

        if(auth()->guest() || auth()->user()->role != 'admin'){
            return redirect('/');
        }
        //get the character by id
        $character = Character::find($id);
        //get vision by id
        $vision = Vision::find($id);
        //all visions for vision selection
        $visions = Vision::all();
        return view('/admin/edit', compact('character', 'vision', 'visions'));
    }

    //[admin] goes to add character page
    public function create(){

        if(auth()->guest() || auth()->user()->role != 'admin'){
            return redirect('/');
        }

        $visions = Vision::all();
        return view('admin/addCharacter', compact('visions'));
    }

    //[admin] details character
    public function read($id){

        if(auth()->guest() || auth()->user()->role != 'admin'){
            return redirect('/');
        }
        //find character by id
        $character = Character::find($id);
        //find vision by id
        $vision = Vision::find($id);
        return view('/admin/read', compact('character', 'vision'));
    }

    //[admin] save new character data
    public function store(Request $request){

        if(auth()->guest() || auth()->user()->role != 'admin'){
            return redirect('/');
        }
        //all input fields requires to be filled
        $request->validate([
            'charName' => 'required',
            'charVision' => 'required',
            'charLore' => 'required',
            'charPortrait' => 'required',
        ]);
        //create new character
        $character = new Character;
        //get data from input fields
        $character->name = $request->input('charName');
        $character->vision_id = $request->input('charVision');
        $character->lore = $request->input('charLore');
        $character->portrait = $request->input('charPortrait');
        $character->save();
        return redirect()->back()->with('status','Character Added Succesfully');
    }

    //[admin] saves new data of old character
    public function update(Request $request, $id){

        if(auth()->guest() || auth()->user()->role != 'admin'){
            return redirect('/');
        }

        $request->validate([
            'charName' => 'required',
            'charVision' => 'required',
            'charLore' => 'required',
            'charPortrait' => 'required',
        ]);
        //find character by id
        $character = Character::find($id);
        //get data from input fields
        $character->name = $request->input('charName');
        $character->vision_id = $request->input('charVision');
        $character->lore = $request->input('charLore');
        $character->portrait = $request->input('charPortrait');
        $character->update();
        return redirect()->back()->with('status','Character Updated Succesfully');
    }

    //[admin] delete character
    public function destroy($id){

        if(auth()->guest() || auth()->user()->role != 'admin'){
            return redirect('/');
        }
        //find character by id
        $character = Character::find($id);
        $character->delete();
        return redirect()->back()->with('status','Character Deleted Successfully');
    }

    //character page
//    public function characterPage($id){
//
//        $character = Character::find($id);
//        return view('/characters/characterPage', ['character' => $character]);
//    }

    //favorite a character
    public function favorite(Request $request){
        //if user is a guest
        if(auth()->guest()){
            //redirect back with status message
            return redirect()->back()->with('status', 'Please log in first');
        } else {
            //find authenticated user by their id
            $user = User::find(auth()->id());
            //find character by id
            $character = Character::find($request->input('id'));
            //attach character to user as fav
            $character->user()->attach($user);
            //save to database
            $character->save();
            return redirect()->back()->with('status', 'Character has been added to favorites');
        }
    }

    public function unfavorite(Request $request){
        //find authenticated user by their id
        $user = User::find(auth()->id());
        //find character by id
        $character = Character::find($request->input('id'));
        //detach character from user
        $character->user()->detach($user);
        //save to database
        $character->save();
        return redirect()->back()->with('status', 'Character has been removed from favorites');
    }

    //
//    public function getFavorites(){
////        $user = User::find(auth()->id());
//        $characters = Favorite::all();
//        return view('/characters/favorites', compact('characters'));
//    }

    //character status update switch
    public function updateStatus(Request $request){
        //find character by their id
        $character = Character::findOrFail($request->character_id);
        //get data from input field/checkbox/switch
        $character->status = $request->input('status');
        //save to database
        $character->save();

        return response()->json(['status'=> 'Character active status changed succesfully']);
    }
}
