<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function purchasePage(Request $request){
        $data = Food::where('id',$request->id)->first();
        $data['quantity'] = $request->quantity;
        return view('User.shop.purchase',compact('data'));
    }
}
