@extends('Admin.layout.master')
@section('title','Home')
@section('pageName')
<i class="fa-solid fa-house"></i> Home
@endsection
@section('content')
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-10 offset-1">
                <div class="row">
                    <div class="card" style="width: 100%;">
                        <img src="@if (isset($bannerData->photo))
                        {{asset('storage/'.$bannerData->photo)}}
                        @endif" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Context</h5>
                            <p class="card-text">@if (isset($bannerData->context))
                                {{$bannerData->context}}
                            @endif</p>
                            <form action="{{route('admin#bannerEdit')}}" method="GET">
                                <button type="submit" class="btn bg-theme hover">
                                    Edit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row pt-5">
                    <div class="form-control">
                        <form action="{{route('admin#selectHeader',['title'=>'selectHeader'])}}" method="POST" class=" d-flex flex-column align-items-center mb-3">
                            @csrf
                            <h4 for=""><b>Title</b></h4>
                            <input name="context" 
                            value="@if (isset($selectHeader->context)){{$selectHeader->context}}@endif" 
                            type="text" class=" text-center w-50 form-control mb-2">
                            <button type="submit" class="btn bg-theme hover">Change</button>
                        </form>
                        <hr>
                        <div class=" d-flex justify-content-center mb-3">
                            <a href="{{route('admin#selectFood')}}" class=" shadow-lg btn bg-theme hover">Select Food</a>
                        </div>
                        @if (($foodItems->count() == null))
                            <div class=" d-flex justify-content-center align-items-center" style="height:60vh">
                                <div class="offset-4 col-4">
                                    <h1 class=" text-black-50">Empty</h1>
                                </div>
                            </div>
                        @else
                            <div class=" d-flex flex-wrap justify-content-center">
                                @foreach ($foodItems as $item)
                                <div class=" ms-3 mb-3">
                                    <div class="card shadow-lg border-color-theme" style="width: 14rem;">
                                        <img src="{{asset('storage/'.$item['photo'])}}" class="card-img-top m-auto" alt="..." style="width:200px;height:200px;overflow:hidden;object-fit:contain">
                                        <div class="card-body">
                                            <h5 class="card-title"><b>{{$item['name']}}</b></h5>
                                            <p class="card-text bg-light border" style="height: 80px;overflow:auto;">{{Str::limit($item['detail'],60)}}</p>
                                            <hr>
                                            <div class=" card-text btn">
                                                <i class="fa-solid fa-warehouse"></i> <b>{{$item['stock']}}</b>
                                            </div>
                                            <div class="w-75 card-text btn bg-theme">
                                                <i class="fa-solid fa-money-bill"></i> <b>{{$item['price']}}MMK</b>
                                            </div>
                                            <div>
                                                <div class=" mt-3 w-50">
                                                <a href="{{route('admin#editItem#Food',$item['id'])}}">
                                                    <button class="btn btn-primary"><i class="fa-solid fa-pen"></i></button>
                                                </a>
                                                <a href="{{route('admin#deleteItem#Food',$item['id'])}}">
                                                    <button class="btn btn-danger float-end"><i class="fa-solid fa-trash"></i></button>
                                                </a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                @endforeach
                            </div>
                            {{$foodItems->appends(request()->query())->links()}}
                        @endif

                        <hr>
                        
                        <div class=" d-flex justify-content-center mb-3">
                            <a href="{{route('admin#selectAccessory')}}" class="btn bg-theme hover">Select Accessory</a>
                        </div>
                        @if (($accessoryItems->count() == null))
                            <div class=" d-flex justify-content-center align-items-center" style="height:60vh">
                                <div class="offset-4 col-4">
                                    <h1 class=" text-black-50">Empty</h1>
                                </div>
                            </div>
                        @else
                            <div class=" d-flex flex-wrap justify-content-center">
                                @foreach ($accessoryItems as $item)
                                <div class=" ms-3 mb-3">
                                    <div class="card shadow-lg border-color-theme" style="width: 14rem;">
                                        <img src="{{asset('storage/'.$item['photo'])}}" class="card-img-top m-auto" alt="..." style="width:200px;height:200px;overflow:hidden;object-fit:contain">
                                        <div class="card-body">
                                            <h5 class="card-title"><b>{{$item['name']}}</b></h5>
                                            <p class="card-text bg-light border" style="height: 80px;overflow:auto;">{{Str::limit($item['detail'],60)}}</p>
                                            <hr>
                                            <div class=" card-text btn">
                                                <i class="fa-solid fa-warehouse"></i> <b>{{$item['stock']}}</b>
                                            </div>
                                            <div class="w-75 card-text btn bg-theme">
                                                <i class="fa-solid fa-money-bill"></i> <b>{{$item['price']}}MMK</b>
                                            </div>
                                            <div>
                                                <div class=" mt-3 w-50">
                                                <a href="{{route('admin#editItem#Food',$item['id'])}}">
                                                    <button class="btn btn-primary"><i class="fa-solid fa-pen"></i></button>
                                                </a>
                                                <a href="{{route('admin#deleteItem#Food',$item['id'])}}">
                                                    <button class="btn btn-danger float-end"><i class="fa-solid fa-trash"></i></button>
                                                </a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                @endforeach
                            </div>
                            {{$accessoryItems->appends(request()->query())->links()}}
                        @endif
                        
                    </div>
                </div>
                <div class="row pt-5">
                    <div class="form-control">
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection