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
        //if authenticated user is a guest
        if(Auth::guest()){
            //send to log in page
            return view('/auth/login');

        }

        //get the favorite chars from authenticated user
        $favs = Auth::user()->character;
        //if there are less than three fav characters
        if (count($favs) < 3){
            //send back to prev page
            return back()->with('status', 'In order to edit profile you need to have at least 3 favorites.');
        } else {
            //find user by id
            $users = User::find(1);
            return view('/user/profile', compact('users'));
        }
    }

    public function profileUpdate(Request $request){
        //find authenticated user
        $user = Auth::user();
        //get fav characters
        $favs = Auth::user()->character;
        //if there are >= three fav characters
        if(count($favs) >= 3){
            //validation rules
            $request->validate([
                'username' =>'required|min:4|string|max:255',
                'email'=>'required|email|string|max:255'
            ]);
            //get data from input fields
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->save();
            return back()->with('status','Profile Updated');
        }
        return back()->with('status', 'In order to edit profile you need to have 3 favorites.');
    }
}
