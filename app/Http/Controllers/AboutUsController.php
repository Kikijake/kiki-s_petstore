<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    // Admin
    public function aboutUs(){
        $data = AboutUs::first();
        if($data == null){
            return view('Admin.aboutUs.aboutUs');
        }else{
            return view('Admin.aboutUs.aboutUs',compact('data'));
        }
    }

    public function updateAboutUs(Request $request){
        $data = [
            'header' => $request->header,
            'aboutUs' => $request->aboutUs
        ];
        if(AboutUs::count() == 0){
            AboutUs::create($data);
        }else{
            AboutUs::first()->update($data);
        }
        return redirect()->route('admin#aboutUs');
    }

    // User

    public function aboutUsUser(){
        $data = AboutUs::first();
        if($data == null){
            return view('User.aboutUs.aboutUs');
        }else{
            return view('User.aboutUs.aboutUs',compact('data'));
        }
    }

}
