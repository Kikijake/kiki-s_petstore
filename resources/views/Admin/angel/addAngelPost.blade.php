@extends('Admin.layout.master')
@section('title','Add Angel Posts')
@section('pageName')
    <i class="fa-solid fa-heart"></i>Add Angels Post
@endsection
@section('content')
    <div class=" container-fluid py-5">
        <div class="row">
            <div class=" offset-3 col-6">
                <form class="form-control" action="{{route('admin#addToAngelDb')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class=" d-flex flex-column align-items-center bg-light" style="height: 400px;">
                        <label for="imageUpload" class=" w-100 h-100">
                            <img class=" w-100 h-100" id="imagePreview" src="#" alt="Add Photo" style="object-fit:contain;">
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
                    <hr>
                    <div>
                        <b>Title</b>
                        <input name="header" type="text" value="{{old('header')}}" class=" form-control w-50">
                    </div>
                    <div>
                        <b>Context</b>
                        <textarea name="context" id="" cols="30" rows="8" class=" form-control">{{old('context')}}</textarea>
                    </div>
                    <div class=" d-flex justify-content-end mt-3">
                        <a href="{{route('admin#angelPage')}}" class=" btn bg-danger text-white ">Cancel</a>
                        <button type="submit" class=" btn bg-theme ms-3">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection