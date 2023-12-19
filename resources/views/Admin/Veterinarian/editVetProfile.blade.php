@extends('Admin.layout.master')
@section('title','Edit Profile')
@section('pageName')
<i class="fa-solid fa-pen-to-square"></i> Edit Profile
@endsection
@section('content')
    <div class=" container-fluid py-5">
        <div class="row">
            <div class="offset-1 col-10">
                <form class="form-control" action="{{route('admin#updateVetProfile',['id'=>$vetProfile->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row" style="height: 70vh">
                        <div class="col-5 p-3" style="height: 400px">
                            <div class=" h-100">
                                <label for="imageUpload" class=" w-100 h-100 border shadow-lg hover">
                                    <img id="imagePreview" src="{{asset('storage/'.$vetProfile->photo)}}" alt="Add Image" style="width:100%;height:100%;object-fit:contain;overflow:hidden;">
                                </label>
                            </div>
                            <div class="">
                                <input name="photo" id="imageUpload" class=" d-none" type="file" value="{{old('photo')}}" onchange="previewImage(event)">
                            </div>
                            @error('photo')
                                <small class=" text-danger">{{$message}}</small>
                            @enderror
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
                        <div class=" offset-1 col-5">
                            <div class=" mt-3">
                                <b>Name</b>
                                <input name="name" class=" mt-2 form-control" type="text" value="{{old('name',$vetProfile->name)}}">
                                @error('name')
                                    <small class=" text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class=" mt-3">
                                <b>Position</b>
                                <input name="position" class=" mt-2 form-control" type="text" value="{{old('name',$vetProfile->position)}}">
                                @error('position')
                                    <small class=" text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class=" mt-3">
                                <b>Resume</b>
                                <textarea name="resume" class=" mt-2 form-control" name="" id="" cols="30" rows="5">{{old('name',$vetProfile->resume)}}</textarea>
                                @error('resume')
                                    <small class=" text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class=" mt-3">
                                <a class=" btn bg-danger text-white" href="{{route('admin#vetPage')}}" >Cancel</a>
                                <button class="btn bg-theme">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
@endsection