@extends('Admin.layout.master')
@section('title','Edit Angel Posts')
@section('pageName')
    <i class="fa-solid fa-heart"></i> Edit Angels Post
@endsection
@section('content')
<div class=" container-fluid py-5">
    <div class="row">
        <div class=" offset-3 col-6">
            <form class="card" action="{{route('admin#updatePost#Angel',['id'=>$postData->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class=" d-flex flex-column align-items-center bg-light">
                    <label for="imageUpload" >
                        <img class=" card-img" id="imagePreview" src="{{asset('storage/'.$postData->photo)}}" alt="Add Photo">
                    </label>
                    <input type="file" id="imageUpload" name="photo" class=" d-none"  onchange="previewImage(event)">
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
                <div class=" card-header">
                    <b>Title</b>
                    <input name="header" type="text" value="{{old('header',$postData->header)}}" class=" form-control w-50">
                </div>
                <div class=" card-body">
                    <b>Context</b>
                    <textarea name="context" id="" cols="30" rows="8" class=" form-control">{{old('context',$postData->context)}}</textarea>
                </div>
                <div class=" card-footer d-flex justify-content-end mt-3">
                    <a href="{{route('admin#angelPage')}}" class=" btn bg-danger text-white ">Cancel</a>
                    <button type="submit" class=" btn bg-theme ms-3">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection