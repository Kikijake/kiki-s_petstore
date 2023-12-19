@extends('Admin.layout.master')
@section('title','Select Food')
@section('pageName')
<i class="fa-regular fa-square-check"></i> Select Foods To Show
@endsection
@section('content')
    <div class=" container-fluid pt-5 pb-5">
        <form action="{{route('admin#selectedFood')}}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class=" d-flex justify-content-end px-5">
                    <button class=" btn bg-theme me-5">Done</button>
                </div>
            </div>
            <div class="row ">
                <div class="d-flex flex-wrap">
                    @foreach ($items as $item)
                    <div class=" ms-3 mb-3">
                        <div class="card shadow-lg border-color-theme" style="width: 14rem;">
                            <div class=" pt-2 ps-3">
                                <input type="checkbox" name="selectedItems[]" value="{{ $item['id'] }}" class=" font" style="transform: scale(2);cursor: pointer;" @if ($item['select'] == 'yes') checked @endif>
                            </div>
                            <img src="{{asset('storage/'.$item['photo'])}}" class="card-img-top m-auto" alt="..." style="width:200px;height:200px;overflow:hidden;object-fit:contain">
                            <div class="card-body">
                                <h5 class="card-title"><b>{{$item['name']}}</b></h5>
                                <hr>
                                <div class=" card-text btn">
                                    <i class="fa-solid fa-warehouse"></i> <b>{{$item['stock']}}</b>
                                </div>
                                <div class="w-75 card-text btn bg-theme">
                                    <i class="fa-solid fa-money-bill"></i> <b>{{$item['price']}}MMK</b>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    @endforeach
                </div>
            </div>
        </form>
    </div>
@endsection