<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    function login(Request $req){
        $user = User::where(['email' => $req->email])->first();
        if(!$user || !Hash::check($req->password, $user->password)){
            #echo '<script>alert("Invalid Username or Password")</script>';
            return 0;
        }
        else {
            return $user;
        }
    }
    function register(Request $req){
        
        $existing = User::where('email',$req->email)->first();
        if($existing){
            return 0;
        }

        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->role = "user";
        $user->password = Hash::make($req->password);
        $user->save();
        return $user;
    }

}
