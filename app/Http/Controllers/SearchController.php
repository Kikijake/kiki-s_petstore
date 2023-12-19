<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderBy;
use App\Models\LikePost;
use App\Models\Accessory;
use App\Models\AngelPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    // Admin
    public function searchAdmin(Request $request,$table){
        $key=$request->search;
        // $table = $request->table;
        $type= 'all';
        if($table == 'angel'){
            if($key != null){
                $postDatas = AngelPost::where('header','like','%'.$key.'%')->orwhere('context','like','%'.$key.'%')->orderBy('id','desc')->paginate();
                foreach($postDatas as $postData){
                    $likesFromDb = LikePost::where('postId',$postData)->get();
                    $postData->likes = $likesFromDb->count();
                };
                return view('Admin.angel.angelPost',compact('postDatas'));
            }
            return redirect()->route('admin#angelPage');

        }elseif($table == 'food'){
            if($key != null){
                $items = Food::where('name','like','%'.$key.'%')->orWhere('type','like','%'.$key.'%')->orderBy('updated_at','desc')->paginate(8);
                return view('Admin.food.food',compact(['items','type']));
            }
            return redirect()->route('admin#food',$type);

        }elseif($table == 'accessory'){
            if($key != null){
                $items = Accessory::where('name','like','%'.$key.'%')->orWhere('type','like','%'.$key.'%')->orderBy('updated_at','desc')->paginate(8);
                return view('Admin.accessory.accessory',compact(['items','type']));
            }
            return redirect()->route('admin#accessory',$type);
        }elseif($table == 'order'){
            if($key != null){
                $orderBies = OrderBy::where('id','like','%'.$key.'%')->orWhere('name','like','%'.$key.'%')->orWhere('phone','like','%'.$key.'%')->orWhere('address','like','%'.$key.'%')->get();
                $lists=[];
                $orders=[];
                for($i=0;$i<$orderBies->count();$i++){
                    $orders[$i] = Order::where('orderId',$orderBies[$i]->id)->get();
                    $total=0;
                    foreach($orders[$i] as $order){
                        $total += $order->amount;
                    }
                    $lists[$i] = [
                        'orderBy' => $orderBies[$i],
                        'orders' => $orders[$i],
                        'total' => $total,
                    ];
                }
                $lists = collect($lists);
                $lists = $lists->reverse();
                return view('Admin.order.orderlist',compact('lists'));
                
                
            }
            return redirect()->route('admin#orderPage');
        }

    }



    // 
    public function searchUser(Request $request,$table){
        $key=$request->search;
        // $table = $request->table;
        $type= 'all';
        if($table == 'angel'){
            if($key != null){
                $postDatas = AngelPost::where('header','like','%'.$key.'%')->orderBy('id','desc')->paginate();
                foreach($postDatas as $postData){
                    $likesFromDb = LikePost::where('postId',$postData->id)->get();
                    $postData->likes = $likesFromDb->count();
                    $checklike = LikePost::where('postId',$postData->id)->where('likeBy',Auth::user()->email)->first();
                    if( $checklike == null){
                        $postData->liked = "no";
                    }else{
                        $postData->liked = "yes";
                    }
                }
                return view('User.angel.angelPage',compact('postDatas'));
            }
            return redirect()->route('user#angel');

        }elseif($table == 'food'){
            if($key != null){
                $items = Food::where('name','like','%'.$key.'%')->orWhere('type','like','%'.$key.'%')->orderBy('updated_at','desc')->paginate(8);
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
                return view('User.food.food',compact(['items']));
            }
            return redirect()->route('user#food',$type);

        }elseif($table == 'accessory'){
            if($key != null){
                $items = Accessory::where('name','like','%'.$key.'%')->orWhere('type','like','%'.$key.'%')->orderBy('updated_at','desc')->paginate(8);
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
                return view('User.accessory.accessory',compact(['items']));
            }
            return redirect()->route('user#accessory',$type);
        }

    }
}
