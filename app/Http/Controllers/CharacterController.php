<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Character_Vision;
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
//            $vision = Vision::all();
            $characters = Character::where('name', 'like', "%$search%")->get();
//                ->orWhere('charVision', 'like', '%' . request('search') . '%')
                //->orWhere('lore', 'like', "%$search%");
//            $vision->where('visions.vision', 'like', '%' . request('search') . '%')
//                ->whereColumn('visions.id', 'character_vision.vision_id');

            return view('/characters/index', compact('characters'));
        }
        //loads all characters
        else{
            //first added > last added
            $character = Character::all();
            return view('/characters/index', [
                'characters' => $character
            ]);
        }
    }

    //[Admin] View list of all characters in table
    public function overview(){

        if(auth()->guest() || auth()->user()->role != 'admin'){
            abort(\Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
        }
        //search
        if(request('search')){
            //last added > first added
            $search = request('search');
            $characters = Character::where('name', 'like', "%$search%")->get();
            return view('/admin/overview', compact('characters'));
        }
        $characters = Character::all();
        return view('/admin/overview',compact('characters'));
    }

    //[admin] edit form
    public function edit($id){

        if(auth()->guest() || auth()->user()->role != 'admin'){
            abort(\Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
        }

        $character = Character::find($id);
        $vision = Vision::find($id);
        $visions = Vision::all();
        return view('/admin/edit', ['character' => $character, 'vision' => $vision, 'visions'=> $visions]);
    }

    //[admin] add a new character
    public function create(){

        if(auth()->guest() || auth()->user()->role != 'admin'){
            abort(\Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
        }

        $visions = Vision::all();
        return view('admin/addCharacter',['visions' => $visions]);
    }

    //[admin] details character
    public function read($id){

        if(auth()->guest() || auth()->user()->role != 'admin'){
            abort(\Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
        }

        $character = Character::find($id);
        $vision = Vision::find($id);
        return view('/admin/read', ['character' => $character, 'vision' => $vision]);
    }

    //[admin] save new character
    public function store(Request $request){

        if(auth()->guest() || auth()->user()->role != 'admin'){
            abort(\Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
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
            abort(\Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
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
            abort(\Symfony\Component\HttpFoundation\Response::HTTP_FORBIDDEN);
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


    //toggle switch
    public function toggle(Request $request){
        $character = Character::find($request->id);
        $character->status = $request->status;
        $character->save();

        return redirect()->back()->with('status', 'Character active status changed');
    }

    public function favorite(Request $request, Character $character){
        $user = User::find(auth()->id());
        $character = Character::find($request->input('id'));
        $character->save();
        $character->user()->attach($user);
        return redirect()->back()->with('status', 'Character has been added to favorites');
    }

    public function unfavorite(Request $request, Character $character){
        $user = User::find(auth()->id());
        $character = Character::find($request->input('id'));
        $character->save();
        $character->user()->detach($user);
        return redirect()->back()->with('status', 'Character has been removed from favorites');
    }
}
