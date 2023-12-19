<?php

namespace App\Http\Controllers;

use App\Models\Vet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VetController extends Controller
{
    //Admin
    public function vetPage(){
        $vetProfiles = Vet::orderBy('id','desc')->get();
        return view('Admin.Veterinarian.vetPage',compact('vetProfiles'));
    }

    // Direct To Add Profile
    public function addProfile(){
        return view('Admin.Veterinarian.addVetProfile');
    }

    // Add Profile
    public function addToVetDb(Request $request){
        $this->vetValidation($request);
        $data = $this->getData($request);
        if($request->hasFile('photo')){

            $filename =  $request->type.uniqid().$request->file('photo')->getClientOriginalName();
            $request->file('photo')->storeAs('public',$filename);
            $data['photo'] = $filename;

        };
        Vet::create($data);
        return redirect()->route('admin#vetPage');
    }

    // Delete Profile
    public function deleteVetProfile($id){
        Vet::where('id',$id)->delete();
        return back();
    }

    // Edit Profile
    public function editVetProfile($id){
        $vetProfile=Vet::where('id',$id)->first();
        return view('Admin.Veterinarian.editVetProfile',compact('vetProfile'));
    }

    // Update Profile
    public function updateVetProfile(Request $request){
        $this->vetUpdateValidation($request);
        $data = $this->getData($request);
        if($request->hasFile('photo')){
            $dbData = Vet::where('id',$request->id)->first();
            $dbphoto = $dbData->photo;

            if($dbphoto != null){
                Storage::delete('public/'.$dbphoto);
            }

            $filename = uniqid().$request->file('photo')->getClientOriginalName();
            $request->file('photo')->storeAs('public',$filename);
            $data['photo'] = $filename;
            
        };
        Vet::where('id',$request->id)->update($data);
        return redirect()->route('admin#vetPage');
    }

    // Get Data
    public function getData($request){
        return [
            'name' => $request->name,
            'position' => $request->position,
            'resume' => $request->resume
        ];
    }

    // Validation For Add Data
    private function vetValidation($request){
        Validator::make($request->all(),[
            'photo' => 'required',
            'name' => 'required',
            'position' => 'required',
            'resume' => 'required',
        ])->validate();
    }

    // Validation For Update Data
    private function vetUpdateValidation($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'position' => 'required',
            'resume' => 'required',
        ])->validate();
    }

    // User
    public function vetPageUser(){
        $vetProfiles = Vet::orderBy('id','desc')->get();
        return view('User.Veterinarian.vetPage',compact('vetProfiles'));
    }

}
