@extends('User.layout.master')
@section('title','Veterinarian')
@section('myContent')
<div class="container-fluid" style=" padding-top:90px;">
    <div class="row mt-3">
        <div class=" col-10 offset-1">
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
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection