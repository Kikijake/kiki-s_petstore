<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderBy;
use App\Models\Accessory;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // User
    public function buyPage(Request $request){
        $datas = $this->getDataCart();
        $total = $this->total($datas);
        return view('User.shop.buy',compact(['datas','total']));
    }

    // Buying Items From the Cart
    public function order(Request $request){
        $data = $this->getDataForOrderBy($request);
        
        OrderBy::create($data);
        $dataDb = OrderBy::where('email',Auth::user()->email)->get();
        for($i=0;$i<$dataDb->count();$i++){
            $orderId = $dataDb[$i]->id;
            $created_at = $dataDb[$i]->created_at;
            $updated_at = $dataDb[$i]->updated_at;
        }
        $datas = $this->getDataCartForOrder();
        foreach($datas as $data){
            
        }
        $orderData = [];
        for($i=0;$i<count($datas);$i++){
            $orderData[$i] = [
                'orderId' => $orderId,
                'name' => $datas[$i]->name,
                'quantity' => $datas[$i]->quantity,
                'amount' => $datas[$i]->price * $datas[$i]->quantity,
                'created_at' => $created_at,
                'updated_at' => $updated_at
            ];
        };
        Order::insert($orderData);
        Cart::where('orderBy',Auth::user()->email)->delete();

        $dataDb = OrderBy::where('email',Auth::user()->email)->get();
        $dataDb = collect($dataDb)->last();
        

        $noti = [
            'user' => Auth::user()->name,
            'message' => 'Ordered Some Items(OrderId #'.$dataDb->id.')',
            'route' => 'admin#orderPage',
        ];
        Notification::create($noti);
        
        return redirect()->route('user#orderHistory');
    }

    // Order History
    public function orderHistory(){
        $orderBies = OrderBy::where('email',Auth::user()->email)->get();
        $lists = $this->orderData($orderBies);
        $lists = collect($lists);
        $lists = $lists->reverse();
        return view('User.order.orderHistory',compact('lists'));
    }

    // Data For OrderBy
    public function getDataForOrderBy($request){
        return [
            'name' => $request->name,
            'email' => Auth::user()->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'note' => $request->note,
        ];
    }

    // Data From Cart
    public function getDataCart(){
        $dataDb = Cart::where('orderBy',Auth::user()->email)->get();

        if($dataDb->count() > 0){

            $data = [];
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
            }
            
        }else{
            $datas = "empty";
        }
        return $datas;
    }

    // Get Data From Cart and Decrease Stock
    public function getDataCartForOrder(){
        $dataDb = Cart::where('orderBy',Auth::user()->email)->get();

        if($dataDb->count() > 0){

            $data = [];
            for($i=0;$i<$dataDb->count();$i++){
                $data = $dataDb[$i];
                if($data->type == 'food'){
                    $datas[$i] = Food::where('id',$data->itemId)->first();
                    $remainStock = [
                        'stock' => $datas[$i]->stock - $data->quantity,
                    ];
                    Food::where('id',$data->itemId)->update($remainStock);
                    $datas[$i]->quantity = $data->quantity;
                    $datas[$i]->cartId = $data->id;
                }else if($data->type == 'accessory'){
                    $datas[$i] = Accessory::where('id',$data->itemId)->first();
                    $remainStock = [
                        'stock' => $datas[$i]->stock - $data->quantity,
                    ];
                    Accessory::where('id',$data->itemId)->update($remainStock);
                    $datas[$i]->quantity = $data->quantity;
                    $datas[$i]->cartId = $data->id;
                }
            }
            
        }
        return $datas;
    }

    // Total Price
    public function total($datas){
        $total = 0;
        foreach($datas as $data){
            $total+=$data->price * $data->quantity;
        }
        return $total;
    }

    // Admin
    public function orderPageAdmin(){
        $orderBies = OrderBy::all();
        $lists = $this->orderData($orderBies);
        $lists = collect($lists);
        $lists = $lists->reverse();
        return view('Admin.order.orderlist',compact('lists'));
    }

    // Data For Order Pages
    public function orderData($orderBies){
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
        return $lists;
    }

    // Process Done
    public function processDone($id){
        $processDone = [
            'process' => 'done'
        ];
        OrderBy::where('id',$id)->update($processDone);
        return back();
    }

    public function processCancel($id){
        $processCancel = [
            'process' => 'cancel'
        ];
        OrderBy::where('id',$id)->update($processCancel);
        return back();
    }

}
