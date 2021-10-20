<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index(){

        if(Auth::user()){
            $users = User::find(1);
            return view('/user/profile',['users' => $users]);
        } else{
            abort(Response::HTTP_FORBIDDEN);
        }
    }

    public function profileUpdate(Request $request){

        //validation rules
        $request->validate([
            'username' =>'required|min:4|string|max:255',
            'email'=>'required|email|string|max:255'
        ]);
        $user =Auth::user();
        $user->username = $request['username'];
        $user->email = $request['email'];
        $user->save();
        return back()->with('status','Profile Updated');
    }
}
