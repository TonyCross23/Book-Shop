<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    // login
    public function register (Request $request) {

        $request->validate([
            'name' => 'required|string',
            "email" => 'required|email|unique:users,email',
            "phone" => 'required|alpha_num|unique:users,phone' ,
            "address" => 'required',
            "gender" => 'required',
            'password' => 'required|min:8|max:25'
        ]);

        $file_name = null;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $file_name = uniqid() . '-'. date('Y-m-d-H-i-s') . '.' . $file->getClientOriginalExtension();
            Storage::put('media/'.$file_name , file_get_contents($file));
        }

        $user = new user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->password = Hash::make($request->password);
        $user->image = $file_name;
        $user->save();

        $token = $user->createToken('Blog')->accessToken;

        return ResponseHelper::success([
            'accept_token' => $token,
        ]);
    }

    // login 
    public function login (Request $request) {
     
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = auth()->user();

            $token = $user->createToken('Token')->accessToken;

            return ResponseHelper::success([
                'accept_token' => $token,
            ]);
            
        }
      
    }
}
