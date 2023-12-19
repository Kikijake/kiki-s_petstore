<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Accessory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AccessoryController extends Controller
{
    //Admin
    //All Accessory
    public function accessoryAdmin($type){
        if($type == "all"){
            $items = Accessory::orderBy('updated_at','desc')->paginate(12);
        }else{
            $items = Accessory::where('type',$type)->orderBy('updated_at','desc')->paginate(12);
        }
        $type = $type;
        // dd($items->toArray());
        return view('Admin.accessory.accessory',compact(['items','type']));
    }

    // Add Item Page
    public function addItemPageAdmin($type){
        $type = $type;
        return view('Admin.accessory.addItem',compact('type'));
    }

    // Create Item In Food DB
    public function addItemDb(Request $request){
        $this->accessoryItemValidation($request);
        $data = $this->getAccessoryItem($request);
        if($request->hasFile('photo')){

            $filename =  $request->type.uniqid().$request->file('photo')->getClientOriginalName();
            $request->file('photo')->storeAs('public',$filename);
            $data['photo'] = $filename;

        };
        Accessory::create($data);
        return redirect()->route('admin#accessory','all');
    }
    
    // Edit Page
    public function editItem($id){
        $data = Accessory::where('id',$id)->first();
        return view('Admin.accessory.editItem',compact('data'));
    }

    // Update Item
    public function updateItem(Request $request){
        $this->accessoryItemValidation($request);
        $data = $this->getAccessoryItem($request);
        if($request->hasFile('photo')){
            $dbData = Accessory::where('id',$request->id)->first();
            $dbphoto = $dbData->photo;

            if($dbphoto != null){
                Storage::delete('public/'.$dbphoto);
            }

            $filename = uniqid().$request->file('photo')->getClientOriginalName();
            $request->file('photo')->storeAs('public',$filename);
            $data['photo'] = $filename;
            
        };
        Accessory::where('id',$request->id)->update($data);
        return redirect()->route('admin#accessory','all');
    }

    
    // Delete
    public function deleteItem($id){
        $data = Accessory::where('id',$id)->first();
        Storage::delete('public/'.$data->photo);
        $data->delete();
        return back();
    }
    
    // Get Item From Add Item Page
    public function getAccessoryItem($request){
        return [
            'name' => $request->name,
            'detail' => $request->detail,
            'type' => $request->type,
            'price' => $request->price,
            'stock' => $request->stock,
        ];
    }

    // Add Item Validation
    private function accessoryItemValidation($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'detail' => 'required',
            'price' => 'required',
        ])->validate();
    }

    // User
    public function accessoryUser($type){
        if($type == "all"){
            $items = Accessory::orderBy('updated_at','desc')->paginate(15);
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
                            // dd($cartData);
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
            $items = Accessory::where('type',$type)->orderBy('updated_at','desc')->paginate(15);
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
        return view('User.accessory.accessory',compact(['items']));
    }
}
