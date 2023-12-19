@extends('Admin.layout.master')
@section('title','Accessory')
@section('pageName')
<i class="fa-solid fa-toilet"></i> Accessory
@endsection
@section('search')
<div class=" form-control text-center h-50 align-self-center" style="width: 300px">
    <form action="{{route('admin#search',['table'=>'accessory'])}}" method="GET">
        @csrf
        <button class=" border-0" for="search"><i class="fa-solid fa-magnifying-glass hover"></i></button>
        <input type="text" name="search" id="search" class=" ps-1" style="border: none;width:250px;" placeholder="  Search Food  ">
    </form>
</div>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row mt-3">
            <div class=" col-10 offset-1">
                <div class="container">
                    <div class="row">
                        <a class="btn col-2 offset-10 hover bg-theme" href="{{route('admin#addItemPage#Accessory',$type)}}"><i class="fa-regular fa-square-plus"> </i> Add Item</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="">
                    @if (($items->count() == null))
                        <div class=" d-flex justify-content-center align-items-center" style="height:60vh">
                            <div class="offset-4 col-4">
                                <h1 class=" text-black-50">Empty</h1>
                            </div>
                        </div>
                    @else
                        <div class=" d-flex flex-wrap">
                            @foreach ($items as $item)
                            <div class=" ms-3 mb-3">
                                <div class="card" style="width: 14rem;">
                                    <img src="{{asset('storage/'.$item['photo'])}}" class="card-img-top m-auto" alt="..." style="width:200px;height:200px;overflow:hidden;">
                                    <div class="card-body">
                                        <h5 class="card-title"><b>{{$item['name']}}</b></h5>
                                        <p class="card-text bg-light border" style="height: 80px;overflow:">{{Str::limit($item['detail'],60)}}</p>
                                        <hr>
                                        <div class=" card-text btn">
                                            <i class="fa-solid fa-warehouse"></i> <b>{{$item['stock']}}</b>
                                        </div>
                                        <div class="w-75 card-text btn bg-theme">
                                            <i class="fa-solid fa-money-bill"></i> <b>{{$item['price']}}MMK</b>
                                        </div>
                                        <div>
                                            <div class=" mt-3 w-50">
                                            <a href="{{route('admin#editItem#Accessory',$item['id'])}}">
                                                <button class="btn btn-primary"><i class="fa-solid fa-pen"></i></button>
                                            </a>
                                            <a href="{{route('admin#deleteItem#Accessory',$item['id'])}}">
                                                <button class="btn btn-danger float-end"><i class="fa-solid fa-trash"></i></button>
                                            </a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                {{$items->appends(request()->query())->links()}}
                    
            </div>
        </div>
    </div>
    
@endsection