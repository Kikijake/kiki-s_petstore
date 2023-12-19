@extends('User.layout.master')
@section('title','profileEdit')
@section('myContent')
    <div class=" container-fluid" style="padding-top: 80px;">
        <div class=" row">
            <div class="col-8 offset-2">
                <div class=" form-control">
                    <form action="{{route('user#profileUpdate')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="offset-1 col-4">
                                {{-- Photo Start --}}
                                <div class="row mt-4">
                                    <div>
                                        <label for="imageUpload" >
                                            <div style="width:200px;height:200px;" class="border shadow-sm">
                                                <img id="imagePreview" src="{{asset('storage/'.Auth::user()->photo)}}" alt="Image Preview" style="width:100%;height:100%;object-fit:cover;overflow:hidden;" >
                                            </div>
                                        </label>
                                    </div>
                                    <input type="file" id="imageUpload" class=" d-none mt-2 mb-3 form-control @error('photo') is-invalid @enderror" name="photo" value="{{old('photo')}}" onchange="previewImage(event)">
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
                                {{-- Photo End --}}
                            </div>
                            <div class="offset-1 col-4 pt-3">
                                {{-- Detail Start --}}
                                <div>
                                    <b class=" text-bold color-theme" for="">Name</b>
                                    <input class=" form-control mt-2 mb-3 @error('name') is-invalid @enderror" type="text" name="name" value="{{old('name',Auth::user()->name)}}">
                                    @error('name')
                                        <small class=" text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div>
                                    <b for="" class="color-theme">Email</b>
                                    <input class=" form-control mt-2 mb-3 @error('email') is-invalid @enderror" type="email" name="email" value="{{old('email',Auth::user()->email)}}">
                                    @error('email')
                                        <small class=" text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div>
                                    <b for="" class="color-theme">Phone</b>
                                    <input class=" form-control mt-2 mb-3 @error('email') is-invalid @enderror" type="phone" name="phone" value="{{old('phone',Auth::user()->phone)}}">
                                    @error('phone')
                                        <small class=" text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div>
                                    <b for="" class="color-theme">Address</b>
                                    <input class=" form-control mt-2 mb-3 @error('email') is-invalid @enderror" type="text" name="address" value="{{old('address',Auth::user()->address)}}">
                                    @error('address')
                                        <small class=" text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                
                                <button class="btn bg-theme hover mt-2 mb-3" type="submit"> Update </button>
                                {{-- Detail Eend --}}
                            </div>
    
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection