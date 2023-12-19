@extends('Admin.layout.master')
@section('title','editPage')
@section('content')

<div class="container-fluid">
    <div class="row">
        <form action="{{route('admin#profileUpdate')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="offset-2 col-8 mt-5 card shadow-lg">
                <div class="row">
                    <div class=" offset-1 col-4">
                        <div class="row mt-4">
                            <img id="imagePreview" src="{{asset('storage/'.Auth::user()->photo)}}" alt="Image Preview" class="col card shadow-sm">
                            <input type="file" id="imageUpload" class="mt-2 mb-3 form-control @error('photo') is-invalid @enderror" name="photo" value="{{old('photo')}}" onchange="previewImage(event)">
                            @error('photo')
                                <small class=" text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <script>
                            function previewImage(event) {
                                const input = event.target;
                                const preview = document.getElementById('imagePreview');
                                
                                if (input.files && input.files[0]) {
                                    const reader = new FileReader();
                                    
                                    reader.onload = function(e) {
                                        preview.src = e.target.result;
                                    }
                                    
                                    reader.readAsDataURL(input.files[0]);
                                }
                            }

                        </script>
                    </div>
                    <div class=" offset-1 col-4 pt-3">
                        <div>
                            <b class=" text-bold" for="">Name</b>
                            <input class=" form-control mt-2 mb-3 @error('name') is-invalid @enderror" type="text" name="name" value="{{old('name',Auth::user()->name)}}">
                            @error('name')
                                <small class=" text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div>
                            <b for="">Email</b>
                            <input class=" form-control mt-2 mb-3 @error('email') is-invalid @enderror" type="email" name="email" value="{{old('email',Auth::user()->email)}}">
                            @error('email')
                                <small class=" text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <b for="">Role</b>
                        <input class=" form-control mt-2 mb-3" type="text" value="{{Auth::user()->role}}" disabled>

                        <button class="btn bg-theme hover mt-2 mb-3" type="submit"> Update </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection