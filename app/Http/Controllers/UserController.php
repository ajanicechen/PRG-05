<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index(){
        $favs = Auth::user()->character;
        if (count($favs) < 3){
            return back()->with('status', 'In order to edit profile you need to have 2 favorites.');
        }
        if(Auth::user()){
            $users = User::find(1);
            return view('/user/profile',['users' => $users]);
        } else{
            return view('/auth/login')->with('status', 'Please Log In');
        }
    }

    public function profileUpdate(Request $request){
        $user = Auth::user();
        $favs = Auth::user()->character;

        if(count($favs) >= 3){
            //validation rules
            $request->validate([
                'username' =>'required|min:4|string|max:255',
                'email'=>'required|email|string|max:255'
            ]);
//            $user = Auth::user();
            $user->username = $request['username'];
            $user->email = $request['email'];
            $user->save();
            return back()->with('status','Profile Updated');
        }
        return back()->with('status', 'In order to edit profile you need to have 2 favorites.');
    }
}
