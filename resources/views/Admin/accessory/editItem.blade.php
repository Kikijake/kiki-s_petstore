@extends('Admin.layout.master')
@section('title','Edit Food')
@section('content')
    <div class=" container-fluid mb-5">
        <div class="row">
            <form action="{{route('admin#updateItem#Accessory',['id' => $data->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="offset-2 col-8 mt-5 card shadow-lg">
                    <div class="row">
                        <div class=" offset-1 col-4 pt-4">
                            <div>
                                <b>Name</b>
                                <input class=" form-control mt-2 mb-3 @error('name') is-invalid @enderror" type="text" name="name" value="{{old('name',$data->name)}}">
                                @error('name')
                                    <small class=" text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div>
                                <b>Details</b>
                                <textarea class=" form-control mt-2 mb-3 @error('detail') is-invalid @enderror" name="detail" id="" cols="30" rows="5">{{old('detail',$data->detail)}}</textarea>
                                @error('detail')
                                    <small class=" text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div>
                                <b>Type</b>
                                <select class=" form-select mt-2 mb-3" name="type" id="">
                                    <option value="dog" @if($data->type == 'dog')selected @endif>Dog</option>
                                    <option value="cat" @if($data->type == 'cat')selected @endif>Cat</option>
                                    <option value="bird" @if($data->type == 'bird')selected @endif>Bird</option>
                                    <option value="aquatic" @if($data->type == 'aquatic')selected @endif>Aquatic</option>
                                </select>
                            </div>
                            <div>
                                <b>Price (MMK)</b>
                                <input class=" form-control mt-2 mb-3 @error('name') is-invalid @enderror" type="number" name="price" id="" value="{{old('price',$data->price)}}">
                                @error('price')
                                    <small class=" text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div>
                                <b>Stock</b>
                                <input class=" form-control mt-2 mb-5" type="number" name="stock" id="" value="{{old('stock',$data->stock)}}">
                            </div>
                        </div>
                        <div class=" offset-2 col-4">
                            <div class="row mt-5">
                                <div class="col d-flex justify-content-center mb-3">
                                    <label for="imageUpload">
                                        <div style="width:200px;height:200px;" class="border shadow-sm hover">
                                            <img id="imagePreview" src="{{asset('storage/'.$data->photo)}}" alt="Image Preview" style="width:100%;height:100%;object-fit:cover;overflow:hidden;">
                                        </div>
                                    </label>
                                </div>
                                <input type="file" id="imageUpload" class=" d-none mt-2 mb-3 form-control @error('photo') is-invalid @enderror" name="photo" value="{{old('photo')}}" onchange="previewImage(event)">
                                @error('photo')
                                    <small class=" text-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="row" style="padding-top: 160px">
                                <a href="{{route('admin#accessory',$data->type)}}" class=" col btn btn-danger hover m-2">Cancel</a>
                                <button class=" col btn bg-theme hover m-2" type="submit"> Update </button>
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
                    </div>
                </div>
            </form>
            
        </div>
    </div>
@endsection