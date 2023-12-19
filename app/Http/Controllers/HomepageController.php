<?php

namespace App\Http\Controllers;

use App\Models\Vet;
use App\Models\Cart;
use App\Models\Food;
use App\Models\homepage;
use App\Models\LikePost;
use App\Models\Accessory;
use App\Models\AngelPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HomepageController extends Controller
{
    public function home(){
        $bannerData = homepage::where('title','banner')->first();
        $selectHeader = homepage::where('title','selectHeader')->first();
        $foodItems = Food::where('select','yes')->orderBy('name','asc')->paginate(4);
        $accessoryItems = Accessory::where('select','yes')->orderBy('name','asc')->paginate(4);
        return view('Admin.home.home',compact(['bannerData','selectHeader','foodItems','accessoryItems']));
    }

    public function bannerEdit(){
        $bannerData = homepage::where('title','banner')->first();
        return view('Admin.home.bannerEdit',compact('bannerData'));
    }


    public function bannerUpdate(Request $request){

        $this->bannerValidation($request);
        $data = $this->getEditedData($request);

        if($request->hasFile('photo')){
            $dbphoto = homepage::where('title',$data['title'])->first();
            
            if($dbphoto != null) {
                $dbphoto = $dbphoto->photo;
                Storage::delete('public/'.$dbphoto);
            };

            $filename = uniqid().$request->file('photo')->getClientOriginalName();
            $request->file('photo')->storeAs('public',$filename);
            $data['photo'] = $filename;

        };
        
        $this->addToHomePage($data);
        return redirect()->route('admin#home');
    }
    
    // Request Edited Data
    public function getEditedData($request){
        return [
            'title' => $request->title,
            'context' => $request->context
        ];
    }
    
    // Banner Validation Check
    private function bannerValidation($request){
        Validator::make($request->all(),[
            'photo' => 'mimes:png,jpg,jpeg|file',
            'context' => 'required'
        ])->validate();
    }

    // Add to HomePage Db
    public function addToHomePage($data){
        $dbHomePage = homepage::where('title',$data['title'])->first();
        if($dbHomePage == null ){
            homepage::create($data);
        }else{
            homepage::where('title',$data['title'])->update($data);
        }
    }

    // Header for Selected Food
    public function selectHeader(Request $request){
        $data = $this->getEditedData($request);
        $this->addToHomePage($data);
        return redirect()->route('admin#home');

    }

    // List of Food to Select
    public function selectfood(){
        $items = Food::all();
        return view('Admin.home.selectFood',compact('items'));
    }

    // Update Food slected or not
    public function selectedFood(Request $request){
        $foodDatas = Food::all();
        foreach($foodDatas as $foodData){
            $select = ['select'=>'no'];
            Food::where('id',$foodData->id)->update($select);
        }
        $selectedFoods = $request->input('selectedItems');
        for($i=0;$i<count($selectedFoods);$i++){
            $select = ['select'=>'yes'];
            Food::where('id',$selectedFoods[$i])->update($select);
        }
        return redirect()->route('admin#home');
    }

    // List of Accessory to Select
    public function selectAccessory(){
        $items = Accessory::all();
        return view('Admin.home.selectAccessory',compact('items'));
    }

    // Update Accessory slected or not
    public function selectedAccessory(Request $request){
        $accessoryDatas = Accessory::all();
        foreach($accessoryDatas as $accessoryData){
            $select = ['select'=>'no'];
            Accessory::where('id',$accessoryData->id)->update($select);
        }
        $selectedFoods = $request->input('selectedItems');
        for($i=0;$i<count($selectedFoods);$i++){
            $select = ['select'=>'yes'];
            Accessory::where('id',$selectedFoods[$i])->update($select);
        }
        return redirect()->route('admin#home');
    }


    // User
    public function userHome(){
        $bannerData = homepage::where('title','banner')->first();
        $selectHeader = homepage::where('title','selectHeader')->first();
        $foodItems = Food::where('select','yes')->orderBy('name','asc')->paginate(4);
        if(!empty(Auth::user())){
            if(Cart::count()>0){
                $cartData = Cart::all();
                foreach($cartData as $cartData){
                    if($cartData->orderBy == Auth::user()->email){
                        $cartCheck = true;
                    }else{
                        $cartCheck = false;
                    }
                }
                for($i=0;$i<count($foodItems);$i++){
                    if($cartCheck){
                        $cartData = Cart::where('itemId',$foodItems[$i]->id)->where('orderBy',Auth::user()->email)->first();
                        if($cartData != null){
                            $foodItems[$i]->cartQty = $cartData->quantity;
                        }else{
                            $foodItems[$i]->cartQty = 0;
                        }
                    }else{
                        $foodItems[$i]->cartQty = 0;
                    } 
                }
    
            }
        }
        $accessoryItems = Accessory::where('select','yes')->orderBy('name','asc')->paginate(4);
        if(!empty(Auth::user())){
            if(Cart::count()>0){
                $cartData = Cart::all();
                foreach($cartData as $cartData){
                    if($cartData->orderBy == Auth::user()->email){
                        $cartCheck = true;
                    }else{
                        $cartCheck = false;
                    }
                }
                for($i=0;$i<count($accessoryItems);$i++){
                    if($cartCheck){
                        $cartData = Cart::where('itemId',$accessoryItems[$i]->id)->where('orderBy',Auth::user()->email)->first();
                        if($cartData != null){
                            $accessoryItems[$i]->cartQty = $cartData->quantity;
                        }else{
                            $accessoryItems[$i]->cartQty = 0;
                        }
                    }else{
                        $accessoryItems[$i]->cartQty = 0;
                    } 
                }
    
            }
        }
        $postDatas = AngelPost::orderBy('id','desc')->paginate(3);
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
        $vetProfiles = Vet::orderBy('id','desc')->get();



        return view('User.home',compact(['bannerData','selectHeader','foodItems','accessoryItems','postDatas','vetProfiles']));
    }

}
