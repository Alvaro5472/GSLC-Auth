<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleSocialiteController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function callback(){
        $google_user = Socialite::driver('google')->stateless()->user();
        $user = User::where('google_id', $google_user->getId())->first();

        if(!$user){
            $new_user = User::create([
                'name' => $google_user->getName(),
                'email' => $google_user->getEmail(),
                'google_id' => $google_user->getId(),
                'password' => bcrypt('1234242')
            ]);
            Auth::login($new_user);
            return redirect()->intended('home');
        }
        else{
            Auth::login($user);
            return redirect()->intended('home');
        }
    }
}
