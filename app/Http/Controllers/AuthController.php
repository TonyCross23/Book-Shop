<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    //git hub rediret page
    public function githubRedirect (Request $request){
        return Socialite::driver('github')->redirect();
    }

    // github callback
    public function githubCallback (Request $request){
        $userData = Socialite::driver('github')->user();
        // $user->token

        $user = User::where('email' , $userData->email)->where('social','gitHub')->first();

    
        if($user){
            Auth::login($user);
            return redirect('/dashboard');
        }else{
            $uuid = Str::uuid()->toString();
            $user  =  new User();
            $user->name = $userData->name;
            $user->email = $userData->email;
            $user->phone = $userData->phone;
            $user->password = Hash::make($uuid.now());
            $user->social = "gitHub";
            $user->save();

            Auth::login($user);
            return redirect('/dashboard');
        }
    }

    // google account login
    public function googleRedirect(Request $request){
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback (Request $request){
        $userData = Socialite::driver('google')->user();
        // $user->token

       $user = User::where('email' , $userData->email)->where('social' , 'google')->first();

       if($user){
                // direct accept login , have user account
                Auth::login($user);
                return redirect('/dashboard');
       }else{
            $uuid = Str::uuid()->toString();
            $user = new User();
            $user->name = $userData->name;
            $user->email = $userData->email;
            $user->password = Hash::make($uuid.now());
            $user->social = "google";
            $user->save();

            Auth::login($user);
            return redirect('/dashboard');
       }
    }

    // facebook redirect page
    public function facebookRedirect (Request $request){
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookCallback (Request $request){
        $userData = Socialite::driver('facebok')->user();
        // $user->token

        $user = User::where('email',$userData->email)->where('social','facebook')->first();

        if($user){
            // have user account
            Auth::login($user);
            return redirect('/dashboard');
        }else{
            $uuid = Str::uuid()->toString();
            $user = new User();
            $user->name = $userData->name;
            $user->email = $userData->email;
            $user->password = Hash::make($uuid.now());
            $user->social = "facebook";
            $user->save();
    
            Auth::login($user);
            return redirect('/dashboard');
        }
    
    }
}