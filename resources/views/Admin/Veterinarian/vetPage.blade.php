@extends('Admin.layout.master')
@section('title','Veterinarian')
@section('pageName')
<i class="fa-solid fa-house-chimney-medical"></i> Veterinarian
@endsection
@section('content')
<div class="container-fluid" style="height: 90vh;overflow:auto;">
    <div class="row mt-3">
        <div class=" col-10 offset-1">
            <div class="container">
                <div class=" d-flex justify-content-end">
                    <a class="btn col-2 offset-2 hover bg-theme" href="{{route('admin#addProfile')}}"><i class="fa-regular fa-square-plus"> </i> Add Profile</a>
                </div>
            </div>
            @foreach ($vetProfiles as $vetProfile)
                <div class="row" style="height: 50vh">
                    <div class="col-5 p-3" style="height: 400px">
                        <label for="imageUpload" class=" w-100 h-100 border shadow-lg hover">
                            <img id="imagePreview" src="{{asset('storage/'.$vetProfile->photo)}}" alt="Add Image" style="width:100%;height:100%;object-fit:contain;overflow:hidden;">
                        </label>
                    </div>
                    <div class=" offset-1 col-5 d-flex flex-column justify-content-center">
                        <div>
                            <h1><b>{{$vetProfile->name}}</b></h1>
                        </div>
                        <div>
                            <h4>{{$vetProfile->position}}</h4>
                        </div>
                        <div class=" card border-color-theme shadow-lg">
                            <small class=" py-3 px-1" style="font-family: cursive;">{{$vetProfile->resume}}</small>
                        </div>
                        <div class=" mt-3">
                            <a href="{{route('admin#editVetProfile',$vetProfile->id)}}" class=" btn bg-theme text-white"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{route('admin#deleteVetProfile',$vetProfile->id)}}" class=" btn bg-danger text-white"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection