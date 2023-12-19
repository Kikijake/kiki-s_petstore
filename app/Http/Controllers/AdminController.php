<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\homepage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function adminRegister(){
        Auth::logout();
        return view('auth.adminRegister');
    }

    public function profileEdit(){
        return view('Admin.profile.profileEdit');
    }

    public function profileUpdate(Request $request){
        $this->profileUpdateValidation($request);
        $data = [
            'name' => $request->name,
            'email' => $request->email
        ];

        if($request->hasFile('photo')){
            $dbphoto = Auth::user()->photo;

            if($dbphoto != 'Default_User.jpg'){
                Storage::delete('public/'.$dbphoto);
            }

            $filename = uniqid().$request->file('photo')->getClientOriginalName();
            $request->file('photo')->storeAs('public',$filename);
            $data['photo'] = $filename;
            
        };

        User::where('id',Auth::user()->id)->update($data);

        return redirect()->route('admin#home');
    }

    // Profile Update Validation
    private function profileUpdateValidation($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'photo' => 'mimes:png,jpg,jpeg|file'
        ])->validate();
    }

}
