<?php

namespace App\Http\Controllers;

use App\Models\LikePost;
use App\Models\AngelPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AngelPostController extends Controller
{
    // Angel Post
    public function angelPage(){
        $postDatas = AngelPost::orderBy('id','desc')->paginate();
        foreach($postDatas as $postData){
            $likesFromDb = LikePost::where('postId',$postData->id)->get();
            $postData->likes = $likesFromDb->count();
        };
        return view('Admin.angel.angelPost',compact('postDatas'));
    }

    public function addPostPage(){
        return view('Admin.angel.addAngelPost');
    }
    
    // Adding To AngelPost DataBase
    public function addToAngelDb(Request $request){
        $this->angelPageValidator($request);
        $data = $this->getData($request);
        
        if($request->hasFile('photo')){

            $filename =  $request->type.uniqid().$request->file('photo')->getClientOriginalName();
            $request->file('photo')->storeAs('public',$filename);
            $data['photo'] = $filename;

        }

        AngelPost::create($data);
        return redirect()->route('admin#angelPage');
    }

    // Edit Post
    public function editPage($id){
        $postData = AngelPost::where('id',$id)->first();
        return view('Admin.angel.editAngelPostPage',compact('postData'));
    }

    // Update Post
    public function updatePost(Request $request){
        $this->angelPageValidator($request);
        $data = $this->getData($request);

        if($request->hasFile('photo')){
            $dbphoto = AngelPost::where('id',$request->id)->first();
            
            if($dbphoto != null) {
                $dbphoto = $dbphoto->photo;
                Storage::delete('public/'.$dbphoto);
            };

            $filename = uniqid().$request->file('photo')->getClientOriginalName();
            $request->file('photo')->storeAs('public',$filename);
            $data['photo'] = $filename;

        };

        AngelPost::where('id',$request->id)->update($data);
        return redirect()->route('admin#angelPage');
        
    }

    // Delete Post
    public function deletePost($id){
        AngelPost::where('id',$id)->delete();
        LikePost::where('postId',$id)->delete();
        return back();
    }

    public function getData($request){
        return [
            'header' => $request->header,
            'context' => $request->context,
        ];
    }

    private function angelPageValidator($request){
        Validator::make($request->all(),[
            'photo' => 'mimes:png,jpg,jpeg,webp|file',
        ])->validate();
    }

    // User
    public function angelUser(){
        $postDatas = AngelPost::orderBy('id','desc')->paginate();
        foreach($postDatas as $postData){
            $likesFromDb = LikePost::where('postId',$postData->id)->get();
            $postData->likes = $likesFromDb->count();
            if(empty(Auth::user())){
                $postData->liked = "no";
            }else{
                $checklike = LikePost::where('postId',$postData->id)->where('likeBy',Auth::user()->email)->first();
                if( $checklike == null){
                    $postData->liked = "no";
                }else{
                    $postData->liked = "yes";
                }
            }
        }

        return view('User.angel.angelPage',compact('postDatas'));
    }

    public function liked($liked,$id){
        if($liked == "no"){
            $likeData = [
                'postId' => $id,
                'likeBy' => Auth::user()->email
            ];
            LikePost::create($likeData);
        }else{
            LikePost::where('postId',$id)->where('likeBy',Auth::user()->email)->delete();
        }
        return redirect('/angels#'.$id);
    }


}
