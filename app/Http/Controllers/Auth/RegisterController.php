<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(){
        if(Auth::check() === true){
            return redirect()->route('index_events');
        }

        return view('auth.register');
    }

    public function registration(Request $request){
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with(['msg' => 'Usuario criado com sucesso!', 'time' => date("Y-m-d H:i:s")]);
    }
}
