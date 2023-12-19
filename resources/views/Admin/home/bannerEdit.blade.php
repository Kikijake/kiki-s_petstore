@extends('Admin.layout.master')
@section('title','BannerEdit')
@section('content')
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-1 offset-11">
                <form action="{{route('admin#home')}}">
                    <button type="submit" class="btn bg-theme">Back</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin#bannerUpdate',['title'=>'banner'])}}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label>Photo</label>
                                <input type="file" class=" form-control @error('photo') is-invalid @enderror" name="photo">
                                @error('photo')
                                    <small class=" text-danger"> {{$message}} </small>
                                @enderror
                            </div>
                            <div>
                                <label for="">Context</label>
                                <input type="text" class=" form-control @error('context') is-invalid @enderror" name="context" 
                                value="@if (isset($bannerData)){{old('context',$bannerData->context)}}@else{{old('context')}}@endif">
                                @error('context')
                                    <small class=" text-danger"> {{$message}} </small>
                                @enderror
                            </div>
                            <div>
                                <button type="submit" class="btn bg-theme mt-2">Done</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection