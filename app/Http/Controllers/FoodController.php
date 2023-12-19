<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FoodController extends Controller
{
    // Admin
    // Food Page
    public function foodAdmin($type){
        if($type == "all"){
            $items = Food::orderBy('updated_at','desc')->paginate(12);
        }else{
            $items = Food::where('type',$type)->orderBy('updated_at','desc')->paginate(4);
        }
        $type = $type;
        return view('Admin.food.food',compact(['items','type']));
    }

    // Add Item Page
    public function addItemPageAdmin($type){
        $type = $type;
        return view('Admin.food.addItem',compact('type'));
    }

    // Create Item In Food DB
    public function addItemDb(Request $request){
        $this->foodItemValidation($request);
        $data = $this->getfoodItem($request);
        if($request->hasFile('photo')){

            $filename =  $request->type.uniqid().$request->file('photo')->getClientOriginalName();
            $request->file('photo')->storeAs('public',$filename);
            $data['photo'] = $filename;

        };
        Food::create($data);
        return redirect()->route('admin#food','all');
    }

    // Edit Page
    public function editItem($id){
        $data = Food::where('id',$id)->first();
        return view('Admin.food.editItem',compact('data'));
    }

    // Update Item
    public function updateItem(Request $request){
        $this->foodItemValidation($request);
        $data = $this->getfoodItem($request);
        if($request->hasFile('photo')){
            $dbData = Food::where('id',$request->id)->first();
            $dbphoto = $dbData->photo;

            if($dbphoto != null){
                Storage::delete('public/'.$dbphoto);
            }

            $filename = uniqid().$request->file('photo')->getClientOriginalName();
            $request->file('photo')->storeAs('public',$filename);
            $data['photo'] = $filename;
            
        };
        Food::where('id',$request->id)->update($data);
        return redirect()->route('admin#food','all');
    }

    // Delete
    public function deleteItem($id){
        $data = Food::where('id',$id)->first();
        Storage::delete('public/'.$data->photo);
        $data->delete();
        return back();
    }

    // Get Item From Add Item Page
    public function getfoodItem($request){
        return [
            'name' => $request->name,
            'detail' => $request->detail,
            'type' => $request->type,
            'price' => $request->price,
            'stock' => $request->stock,
        ];
    }

    // Add Item Validation
    private function foodItemValidation($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'detail' => 'required',
            'price' => 'required',
        ])->validate();
    }

    // User
    public function foodUser($type){
        if($type == "all"){
            $items = Food::orderBy('updated_at','desc')->paginate(15);
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
                    for($i=0;$i<count($items);$i++){
                        if($cartCheck){
                            $cartData = Cart::where('itemId',$items[$i]->id)->where('orderBy',Auth::user()->email)->first();
                            if($cartData != null){
                                $items[$i]->cartQty = $cartData->quantity;
                            }else{
                                $items[$i]->cartQty = 0;
                            }
                        }else{
                            $items[$i]->cartQty = 0;
                        } 
                    }
    
                }
            }
        }else{
            $items = Food::where('type',$type)->orderBy('updated_at','desc')->paginate(15);
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
                    for($i=0;$i<count($items);$i++){
                        if($cartCheck){
                            $cartData = Cart::where('itemId',$items[$i]->id)->where('orderBy',Auth::user()->email)->first();
                            if($cartData != null){
                                $items[$i]->cartQty = $cartData->quantity;
                            }else{
                                $items[$i]->cartQty = 0;
                            }
                        }else{
                            $items[$i]->cartQty = 0;
                        } 
                    }
    
                }
            }
        }
        $type = $type;
        return view('User.food.food',compact(['items']));
        // return view('User.food.food',compact(['items','type']));
    }
}
