<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\Session\Session as SessionSession;
use Session;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    function login(Request $req){
        $user = User::where(['email' => $req->email])->first();
        if(!$user || !Hash::check($req->password, $user->password)){
            #echo '<script>alert("Invalid Username or Password")</script>';
            return redirect('/login');
        }
        else {
            $req->session()->put('user',$user);
            return redirect('/');
        }
    }
    function register(Request $req){
        
        $existing = User::where('email',$req->email)->first();
        if($existing){
            return redirect('/register');
        }

        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->save();
        return redirect('/login');
    }
    function changename(Request $req){
        
        $userId = Session::get('user')['id'];

        DB::table('users')
              ->where('id', $userId)
              ->update(['name' => $req->name]);

        $user = User::where(['id' => $userId])->first();
        
        
        $req->session()->put('user',$user);
        return redirect('/');
    }
}
