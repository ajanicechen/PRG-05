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
            //last added > first added
            //$character = Character::latest();
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

        if(auth()->guest() || auth()->user()->role != 'admin'){
            return redirect('/');
//            abort(\Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
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

        $character = Character::find($id);
        //specific vision selection
        $vision = Vision::find($id);
        //all visions for vision selection
        $visions = Vision::all();
        return view('/admin/edit', [
            'character' => $character,
            'vision' => $vision,
            'visions'=> $visions]);
    }

    //[admin] add a new character
    public function create(){

        if(auth()->guest() || auth()->user()->role != 'admin'){
            return redirect('/');
        }

        $visions = Vision::all();
        return view('admin/addCharacter',['visions' => $visions]);
    }

    //[admin] details character
    public function read($id){

        if(auth()->guest() || auth()->user()->role != 'admin'){
            return redirect('/');
        }

        $character = Character::find($id);
        $vision = Vision::find($id);
        return view('/admin/read', compact('character', 'vision'));
    }

    //[admin] save new character
    public function store(Request $request){

        if(auth()->guest() || auth()->user()->role != 'admin'){
            return redirect('/');
        }

        $request->validate([
            'charName' => 'required',
            'charVision' => 'required',
            'charLore' => 'required',
            'charPortrait' => 'required',
        ]);

        $character = new Character;
        $character->name = $request->input('charName');
        $character->vision_id = $request->input('charVision');
        $character->lore = $request->input('charLore');
        $character->portrait = $request->input('charPortrait');
        $character->save();
        return redirect()->back()->with('status','Character Added Succesfully');
//        $characters = Character::all();
//        return redirect('/overview');
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

        $character = Character::find($id);
        $character->name = $request->input('charName');
        $character->vision_id = $request->input('charVision');
        $character->lore = $request->input('charLore');
        $character->portrait = $request->input('charPortrait');
        $character->update();
        //$character->vision()->detach();
        //$character->vision()->attach($request->input('charVision'));
        return redirect()->back()->with('status','Character Updated Succesfully');
    }

    //[admin] delete character
    public function destroy($id){

        if(auth()->guest() || auth()->user()->role != 'admin'){
            return redirect('/');
        }

        $character = Character::find($id);
        $character->delete();
        return redirect()->back()->with('status','Character Deleted Successfully');
    }

    //character page
    public function characterPage($id){

        $character = Character::find($id);
        return view('/characters/characterPage', ['character' => $character]);
    }

    public function favorite(Request $request){
        if(auth()->guest()){
            return redirect()->back()->with('status', 'Please log in first');
        } else {
            $user = User::find(auth()->id());
            $character = Character::find($request->input('id'));
            $character->save();
            $character->user()->attach($user);
            return redirect()->back()->with('status', 'Character has been added to favorites');
        }
    }

    public function unfavorite(Request $request){
        $user = User::find(auth()->id());
        $character = Character::find($request->input('id'));
        $character->save();
        $character->user()->detach($user);
        return redirect()->back()->with('status', 'Character has been removed from favorites');
    }

    //
    public function getFavorites(){
        $user = User::find(auth()->id());
        $characters = Favorite::all();
        return view('/characters/favorites', compact('characters'));

    }

    //character status update switch
    public function updateStatus(Request $request){

        $character = Character::findOrFail($request->character_id);
        $character->status = $request->status;
        $character->save();

        return response()->json(['status'=> 'Character active status changed succesfully']);
    }
}
