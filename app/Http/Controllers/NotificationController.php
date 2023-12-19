<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Redirect Noti Route
    public function checkNoti($id){
        $seen = [
            'seen' => 'yes'
        ];
        Notification::where('id',$id)->update($seen);
        $noti = Notification::where('id',$id)->first();
        if($noti->value == null){
            return redirect()->route($noti->route);
        }else{
            return redirect()->route($noti->route,$noti->value);
        }
    }
}
