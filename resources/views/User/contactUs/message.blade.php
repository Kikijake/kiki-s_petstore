@extends('User.layout.master')
@section('title','Contact Directly')
@section('myContent')
    <div class="container-fluid" style=" padding-top:90px;">
        <div class="row">
            <div class="col-8 offset-2">
                <div class=" btn bg-white mb-2"><h4 ><b>Contact To Admins</b></h4></div>
                <div class="form-control" style="height:80vh;">
                    <div class=" row pt-2 px-3" style="height: 85%">
                        <div class="border-color-theme w-100 h-100 bg-white overflow-auto" id="parentContainer">
                            @foreach ($msgs as $msg)
                            <div class="row d-flex px-2 py-2
                            @if ($msg->sentBy == 'user')
                                justify-content-end
                            @endif">
                                @if ($msg->sentBy == 'admin')
                                    <b><i class="fa-solid fa-shield-dog"></i> Admin</b>
                                @else
                                    <div class=" d-flex justify-content-end">
                                        <b><i class="fa-solid fa-user"></i> You</b>
                                    </div>
                                @endif
                                <div style="max-width: 25%;" class="@if ($msg->sentBy == 'user')
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
                    <form action="{{route('user#sendMessage')}}" method="POST" class="row">
                        @csrf
                        <div class=" d-flex justify-content-center">
                            <textarea name="message" class=" form-control w-50" cols="40" rows="3" placeholder="Type a message"></textarea>
                            <div class="">
                                <button class="ms-1 mt-1 btn bg-theme text-white">
                                    <i class="fa-solid fa-paw"></i>
                                    <b class="">Send</b>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection