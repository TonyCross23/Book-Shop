<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function adminList (){
        $user = User::first();
        return view('admin.list.list',compact('user'));
    }

    public function ssd (){
        $users = User::query();

        return DataTables::of($users)
                    ->addColumn('action',function($user){
                      if($user->id != Auth::user()->id){
                          return '<a href="#" class="btn btn-danger text-white delete" data-id=" '.$user->id.' ">Delete</a>';             
                      }
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }

    // admin user account delete
    public function destory (User $user){
        $user->delete();
        return 'success';
    }

    // profile
    public function profile () {
        $user = User::first();
        return view('admin.profile.index',compact('user'));
    }

    // changeProfile
    public function changeProfile () {
        $user = User::first();
        return view ('admin.profile.changeProfile',compact('user'));
    }

    // chage'
    public function Change ($id,Request $request) {
      
        $data = $this->getUserData($request);
        $validator = $this->getUserValidationCheck($request);
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        if($request->hasFile('image')){
            $dbImage = User::where('id',$id)->first();
            $dbImage = $dbImage->image;

            $fileName = uniqid().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/.',$fileName);
            $data['image'] = $fileName;
            // dd($fileName);
        }
        
 
        User::where('id',$id)->update($data);
        return redirect()->route('admin@changeProfile')->with('success');
    }


// change Password page
public function changePasswordPage () {
    return view('admin.profile.changePassword');
}

// chage Password
public function changePassword (Request $request){
    $validator = $this-> getPasswordValidation($request);
    $user = User::select('password')->where('id',Auth::user()->id)->first();
    if ($validator->fails()) {
        return back()
                    ->withErrors($validator)
                    ->withInput();
    }



    if(Hash::check($request->oldPassword,$user->password)){
        $data = [
            'password' => Hash::make($request->newPassword)
        ];

        User::where('id',Auth::user()->id)->update($data);
        return back()->with('success' , 'Successfuly Changed Password');
    }

    return back()->with(['notMatch' => 'The Old Password not Match. Try Again!']);
}

private function  getPasswordValidation($request){
    return Validator::make($request->all(),[
        'oldPassword' => 'required',
        'newPassword' => 'required'
    ]);
}

    private function getUserData ($request){
        return [
            'name' => request()->adminName,
            'email' => request()->adminEmail,
            'phone' => request()->adminPhone,
            'address' => request()->adminAddress,
            'gender' => request()->adminGender,
            
        ];
    }

    private function getUserValidationCheck ($request){
          return  Validator::make($request->all(), [
                'adminName' => 'required',
                'adminEmail' => 'required',
                'adminPhone' => 'required',
                'adminAddress' => 'required',
                'adminGender' => 'required',
                'image' => 'mimes:png,jpg,jpeg,web,jfif|file'
            ]);
    
           
    }
}