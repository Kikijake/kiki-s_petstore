<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // User
    // Message Page
    public function message(){
        $msgs = Message::where('user',Auth::user()->email)->get();
        return view('User.contactUs.message',compact('msgs'));
    }

    public function sendMessage(Request $request){
        if($request->message == null){
            return back();
        }
        $msgData = [
            'sentBy' => 'user',
            'user' => Auth::user()->email,
            'message' => $request->message
        ];
        Message::create($msgData);
        $noti = [
            'user' => Auth::user()->name,
            'message' => 'Sent A Message',
            'route' => 'admin#message',
            'value' => Auth::user()->email
        ];
        Notification::create($noti);
        
        return back();
    }


    // Admin

    public function messageAdmin($user){
        $orderedMsgs = Message::orderBy('id','desc')->get();
        $msgUsers = $orderedMsgs->unique('user')->pluck('user');
        if($user == 'latest'){
            $msgs= Message::where('user',$msgUsers[0])->get();
        }else{
            $msgs= Message::where('user',$user)->get();
        }
        foreach($msgs as $msg){
            $msg->name = User::where('email',$msg->user)->first()->name;
        }
        for($i=0;$i<count($msgUsers);$i++){
            $msgUsers[$i] = User::where('email',$msgUsers[$i])->first();
        }
        return view('Admin.ContactUs.message',compact(['msgUsers','msgs']));
    }

    public function sendMessageAdmin(Request $request){
        if($request->message == null){
            return back();
        }
        $msgData = [
            'sentBy' => 'admin',
            'user' => $request->email,
            'message' => $request->message
        ];
        Message::create($msgData);
        
        return back();
    }
}
