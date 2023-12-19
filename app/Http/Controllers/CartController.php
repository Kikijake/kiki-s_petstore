<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Food;
use App\Models\Accessory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Cart Page
    public function cartPage(){
        $dataDb = Cart::where('orderBy',Auth::user()->email)->get();
        $data = [];
        $total = 0;
        if($dataDb->count() > 0){
            for($i=0;$i<$dataDb->count();$i++){
                $data = $dataDb[$i];
                if($data->type == 'food'){
                    $datas[$i] = Food::where('id',$data->itemId)->first();
                    $datas[$i]->quantity = $data->quantity;
                    $datas[$i]->cartId = $data->id;
                }else if($data->type == 'accessory'){
                    $datas[$i] = Accessory::where('id',$data->itemId)->first();
                    $datas[$i]->quantity = $data->quantity;
                    $datas[$i]->cartId = $data->id;
                }
                $total += $datas[$i]->price * $datas[$i]->quantity;
            }
        }else{
            $datas = "empty";
        }
        return view('User.shop.cart',compact(['datas','total']));
    }

    // Add To Cart Button
    public function addToCart(Request $request){
        $data = $this->getData($request);
        $dbCart = Cart::where('itemId',$data['itemId'])->where('type',$data['type'])->first();
        if($dbCart == null){
            Cart::create($data);
        }else{
            $data['quantity'] = $dbCart->quantity + $data['quantity'];
            Cart::where('itemId',$data['itemId'])->update($data);
        };
        return redirect()->route('user#cartPage');
    }

    // Decrease Quantity
    public function decreaseCart($cartId){
        $dataDb = Cart::where('id',$cartId)->first();
        $data = $this->getQuantityFromDb($dataDb);
        $data['quantity'] -= 1;
        if($data['quantity'] == 0){
            Cart::where('id',$cartId)->delete();
        }else{
            Cart::where('id',$cartId)->update($data);
        }
        return back();
    }

    // Increase Quantity
    public function increaseCart($id,$cartId){
        $dataDb = Cart::where('id',$cartId)->first();
        $data = $this->getQuantityFromDb($dataDb);
        $cartType = $dataDb->type;
        if($cartType == 'food'){
            $foodData = Food::where('id',$id)->first();
            if($data['quantity'] < $foodData->stock){
                $data['quantity'] += 1;
            }
        }elseif($cartType == 'accessory'){
            $accessoryData = Accessory::where('id',$id)->first();
            if($data['quantity']<$accessoryData->stock){
                $data['quantity'] += 1;
            }
        }
        Cart::where('id',$cartId)->update($data);
        return back();
    }

    // Clear Cart
    public function clearCart(){
        Cart::where('orderBy',Auth::user()->email)->delete();
        return redirect()->route('user#cartPage');
    }

    // Get Data For Add To Cart
    public function getData($request){
        return [
            'orderBy' => Auth::user()->email,
            'itemId' => $request->id,
            'quantity' => $request->quantity,
            'type' => $request->type,
        ];
    }

    // Get Data From CartDb
    public function getQuantityFromDb($dataDb){
        return [
            'quantity' => $dataDb->quantity,
        ];
    }
}
