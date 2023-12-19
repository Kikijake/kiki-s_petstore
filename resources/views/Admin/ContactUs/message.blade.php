@extends('Admin.layout.master')
@section('title','Message')
@section('pageName')
<i class="fa-regular fa-message"></i> Messages
@endsection
@section('content')
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-9">
                <div class=" row pt-2 px-3" >
                    <div class=" w-100 overflow-auto" style="height: 65vh" id="parentContainer">
                        @foreach ($msgs as $msg)
                            <div class="row d-flex px-2 py-2
                            @if ($msg->sentBy == 'admin')
                                justify-content-end
                            @endif">
                                @if ($msg->sentBy == 'user')
                                    <b><i class="fa-solid fa-user"></i> {{$msg->name}}</b>
                                @else
                                    <div class=" d-flex justify-content-end">
                                        <b><i class="fa-solid fa-shield-dog"></i> Admin</b>
                                    </div>
                                @endif
                                <div style="max-width: 25%;" class="@if ($msg->sentBy == 'admin')
                                    d-flex justify-content-end
                                @endif">
                                    <div class="px-2 py-1 rounded bg-theme" style="display:inline-block;">
                                        <b id="{{$msg->id}}" class=" m-0 text-white" >{{$msg->message}}</b>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <script>
                    // Get a reference to the parent container and the last child element
                    var parentContainer = document.getElementById("parentContainer");
                    var lastChildElement = parentContainer.lastElementChild;

                    // Set the scrollTop property of the parent container to show the last child element
                    parentContainer.scrollTop = lastChildElement.offsetTop;
                </script>
                <form action="{{route('admin#sendMessage',['email'=>$msgs[0]->user])}}" method="POST" class="row bg-white border-color-theme py-3 mx-3" style="height:22vh">
                    @csrf
                    <div class=" d-flex justify-content-center">
                        <textarea name="message" class=" border-color-theme form-control w-50" cols="40" rows="3" placeholder="Type a Message"></textarea>
                        <div class=" ms-3">
                            <button class=" btn bg-theme text-white">
                                <i class="fa-solid fa-paw"></i>
                                <b class="">Send</b>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-3 h-100 bg-white border-color-theme">
                <div class="row bg-theme border-top">
                    <h3 class=" text-white">Users</h3>
                </div>
                @foreach ($msgUsers as $user)
                    <div class=" mt-2 p-1 rounded w-50 @if ($msgs[0]->user == $user->email)
                        bg-dark
                    @else
                        bg-theme
                    @endif">
                        <a href="{{route('admin#message',$user['email'])}}" class="text-white">
                            <b><i class="fa-solid fa-user"></i> {{$user->name}}</b>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection