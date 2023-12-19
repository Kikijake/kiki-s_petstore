@extends('User.layout.master')
@section('title','Angels')
@section('myContent')
<div class="container-fluid" style=" padding-top:90px;">
    <div class="row d-flex justify-content-center mb-4">
        <div class=" form-control text-center h-50 align-self-center" style="width: 300px">
            <form action="{{route('user#search',['table'=>'angel'])}}" method="GET">
                @csrf
                <button class=" border-0" for="search"><i class="fa-solid fa-magnifying-glass hover"></i></button>
                <input type="text" name="search" id="search" class=" ps-1" style="border: none;width:250px;" placeholder="  Search Food  ">
            </form>
        </div>
    </div>
    <div class="row">
        <div class=" offset-3 col-6">
            @foreach ($postDatas as $postData)
                <div id="{{$postData->id}}" class=" card mb-4 border-color-theme">
                    <div class="d-flex flex-column align-items-center bg-light">
                        <img class=" card-img" src="@if (isset($postData->photo))
                            {{asset('storage/'.$postData->photo)}}
                        @endif" alt="">
                    </div>
                    <div class="mt-3 card-header">
                        <h3><b>{{$postData->header}}</b></h3>
                    </div>
                    <div class=" card-body">
                        <p>
                            {{$postData->context}}
                        </p>
                    </div>
                    <div class=" card-footer d-flex justify-content-between align-items-center">
                        <p class=" color-theme" style="font-size: 30px;">
                            <a href="{{route('user#liked',[$postData->liked,$postData->id])}}" class=" like-hover">
                                @if ($postData->liked == "no")<i class="fa-regular fa-heart text-danger like-hover"></i>
                                @else<i class="fa-solid fa-heart text-danger like-hover"></i>
                                @endif
                            </a>
                            {{$postData->likes}}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection