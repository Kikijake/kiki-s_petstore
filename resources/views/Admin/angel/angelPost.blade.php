@extends('Admin.layout.master')
@section('title','Angel Posts')
@section('pageName')
    <i class="fa-solid fa-heart"></i> Angels
@endsection
@section('search')
<div class=" form-control text-center h-50 align-self-center" style="width: 300px">
    <form action="{{route('admin#search',['table'=>'angel'])}}" method="GET">
        <button class=" border-0" for="search"><i class="fa-solid fa-magnifying-glass hover"></i></button>
        <input type="text" name="search" id="search" class=" ps-1" style="border: none;width:250px;" placeholder="  Search Post  ">
    </form>
</div>
@endsection
@section('content')
    <div class=" container-fluid py-5">
        <div class="row">
            <div class=" offset-3 col-6">
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{route('admin#addPostPage')}}" class="btn hover bg-theme"><i class="fa-regular fa-square-plus"></i> Add Post</a>
                </div>
                @foreach ($postDatas as $postData)
                    <div class=" card mb-4 border-color-theme">
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
                        <div class=" card-footer d-flex justify-content-between">
                            <p class=" color-theme">
                                {{$postData->likes}} People <i class="fa-solid fa-heart text-danger"></i> this post
                            </p>
                            <div>
                                <a href="{{route('admin#editPostPage#Angel',$postData->id)}}" class="btn btn-primary me-3"><i class="fa-solid fa-pen"></i></a>
                                <a href="{{route('admin#deletePost#Angel',$postData->id)}}" class="btn btn-danger float-end"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection