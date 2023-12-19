@extends('User.layout.master')

@section('myContent')
    <div class="banner-context">
        <img src="@if (isset($bannerData->photo))
                    {{asset('storage/'.$bannerData->photo)}}
                @endif" alt="" class="banner">
        <div class="context">
            <p style="color: white">
                @if (isset($bannerData->context))
                    {{$bannerData->context}}
                @endif
            </p>
            <a href="{{route('user#message')}}" class="btn border-white"><i class="fa-solid fa-message text-white"></i> Contact Now</a>
        </div>
    </div>
    <div style="width: 100%;height:20px;background-color:white;margin-bottom:10px"></div>
    <div class=" px-5 py-2">
        <div class="d-flex justify-content-center mb-3">
            <h1 class=" text-white" style="text-shadow: 2px 2px 10px black;text-decoration:underline;">@if (isset($selectHeader->context))
                {{$selectHeader->context}}
            @endif</h1>
        </div>
        <div class=" d-flex flex-wrap justify-content-center ">
            @if (($foodItems->count() == null))
                <div class=" d-flex justify-content-center align-items-center" style="height:60vh">
                    {{-- <div class="offset-4 col-4"> --}}
                        <h1 class=" text-black-50">Empty</h1>
                    {{-- </div> --}}
                </div>
            @else
                <div class=" d-flex flex-wrap">
                    @foreach ($foodItems as $item)
                    <form action="{{route('user#addToCart',['id'=>$item['id'],'type'=>'food'])}}" method="POST">
                        @csrf
                        <div class=" ms-3 mb-3">
                            <div class="card" style="width: 14rem;">
                                <img src="{{asset('storage/'.$item['photo'])}}" class="card-img-top m-auto" alt="..." style="width:200px;height:200px;overflow:hidden;object-fit:contain">
                                <div class="card-body">
                                    <hr>
                                    <h5 class="card-title">{{$item['name']}}</h5>
                                    <p class="card-text" style="height: 50px;overflow:auto;">{{Str::limit($item['detail'],60)}}</p>
                                    <hr>
                                    {{-- <div class=" card-text btn bg-theme text-white">
                                        <b class=" price">MMK {{$item['price']}}</b>
                                    </div> --}}
                                    <label for=""></label>
                                    @if ($item['stock'] == 0)
                                    <div class=" text-danger">
                                        <b>Sold Out!</b>
                                    </div>
                                    @else
                                    <div class="number-input mt-2">
                                        <button type="button" class="decrement btn" onclick="decrease(this, {{$item['price']}})"><i class="fa-solid fa-minus"></i></button>
                                        <input type="number" name="quantity" class="quantity" value="0" min="0" max="{{$item['stock']-$item['cartQty']}}">
                                        <button type="button" class="increment btn" onclick="increase(this, {{$item['price']}})"><i class="fa-solid fa-plus"></i></button>
                                    </div>
                                    <b class="price btn bg-theme text-white mt-2">MMK {{$item['price']}}</b>
                                    <div class=" mt-2">
                                        <button type="submit" class="btn btn-primary" ><i class="fa-solid fa-cart-shopping"></i> Add to Cart</button>
                                    </div>
                                    
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                    @endforeach
                    <script>
                        function decrease(button, price) {
                          const quantityInput = button.nextElementSibling;
                          const priceElement = button.parentElement.nextElementSibling;
                          quantityInput.stepDown();
                          updatePrice(quantityInput, priceElement, price);
                        }
                      
                        function increase(button, price) {
                            const quantityInput = button.previousElementSibling;
                          const priceElement = button.parentElement.nextElementSibling;
                          quantityInput.stepUp();
                          updatePrice(quantityInput, priceElement, price);
                        }
                      
                        function updatePrice(input, priceElement, price) {
                          const priceValue = price * input.value;
                          priceElement.textContent = "MMK " + priceValue;
                        }
                        </script>
                </div>
                {{$foodItems->links()}}
            @endif
        </div>
        <div class=" d-flex justify-content-center mb-3">
            <div class=" w-25">
                <hr class="bg-white">
            </div>
            <div class=" w-25 ">
                <hr class='bg-white'>
            </div>
            <a href="{{route('user#food',['all'])}}" class=" shadow-lg btn bg-white hover border"><i class=" text-danger fa-solid fa-bone"></i> Shop All Food</a>
        </div>


        <div class=" d-flex flex-wrap justify-content-center ">
            @if (($accessoryItems->count() == null))
                <div class=" d-flex justify-content-center align-items-center" style="height:60vh">
                    {{-- <div class="offset-4 col-4"> --}}
                        <h1 class=" text-black-50">Empty</h1>
                    {{-- </div> --}}
                </div>
            @else
                <div class=" d-flex flex-wrap">
                    @foreach ($accessoryItems as $item)
                    <form action="{{route('user#addToCart',['id'=>$item['id'],'type'=>'accessory'])}}" method="POST">
                        @csrf
                        <div class=" ms-3 mb-3">
                            <div class="card" style="width: 14rem;">
                                <img src="{{asset('storage/'.$item['photo'])}}" class="card-img-top m-auto" alt="..." style="width:200px;height:200px;overflow:hidden;object-fit:contain">
                                <div class="card-body">
                                    <hr>
                                    <h5 class="card-title">{{$item['name']}}</h5>
                                    <p class="card-text" style="height: 50px;overflow:auto;">{{Str::limit($item['detail'],60)}}</p>
                                    <hr>
                                    {{-- <div class=" card-text btn bg-theme text-white">
                                        <b class=" price">MMK {{$item['price']}}</b>
                                    </div> --}}
                                    <label for=""></label>
                                    @if ($item['stock'] == 0)
                                    <div class=" text-danger">
                                        <b>Sold Out!</b>
                                    </div>
                                    @else
                                    <div class="number-input mt-2">
                                        <button type="button" class="decrement btn" onclick="decrease(this, {{$item['price']}})"><i class="fa-solid fa-minus"></i></button>
                                        <input type="number" name="quantity" class="quantity" value="0" min="0" max="{{$item['stock']-$item['cartQty']}}">
                                        <button type="button" class="increment btn" onclick="increase(this, {{$item['price']}})"><i class="fa-solid fa-plus"></i></button>
                                    </div>
                                    <b class="price btn bg-theme text-white mt-2">MMK {{$item['price']}}</b>
                                    <div class=" mt-2">
                                        <button type="submit" class="btn btn-primary" ><i class="fa-solid fa-cart-shopping"></i> Add to Cart</button>
                                    </div>
                                    
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                    @endforeach
                    <script>
                        function decrease(button, price) {
                          const quantityInput = button.nextElementSibling;
                          const priceElement = button.parentElement.nextElementSibling;
                          quantityInput.stepDown();
                          updatePrice(quantityInput, priceElement, price);
                        }
                      
                        function increase(button, price) {
                            const quantityInput = button.previousElementSibling;
                          const priceElement = button.parentElement.nextElementSibling;
                          quantityInput.stepUp();
                          updatePrice(quantityInput, priceElement, price);
                        }
                      
                        function updatePrice(input, priceElement, price) {
                          const priceValue = price * input.value;
                          priceElement.textContent = "MMK " + priceValue;
                        }
                        </script>
                </div>
                {{$accessoryItems->links()}}
            @endif
        </div>
        <div class=" d-flex justify-content-center">
            <div class=" w-25">
                <hr class="bg-white">
            </div>
            <div class=" w-25 ">
                <hr class='bg-white'>
            </div>
            <a href="{{route('user#accessory',['all'])}}" class=" shadow-lg btn bg-white hover border"><i class=" text-danger fa-solid fa-toilet"></i> Shop All Accessory</a>
        </div>
    </div>
    {{-- <div style="width: 100%;height:20px;background-color:white;margin-bottom:10px"></div> --}}
    <div class="d-flex justify-content-center mb-3">
        <h1 class=" text-white" style="text-shadow: 2px 2px 10px black;text-decoration:underline;">Latest Angels Posts</h1>
    </div>
    @if (isset($postDatas))
        <div class=" d-flex justify-content-center">
            @foreach ($postDatas as $postData)
                <div id="{{$postData->id}}" class=" card mx-1 mb-4 border-color-theme" style="width:30%">
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
                    <div class=" card-footer d-flex justify-content-between align-items-center">
                        <p class=" color-theme" style="font-size: 30px;">
                            <a href="{{route('user#liked',[$postData->liked,$postData->id])}}" class=" like-hover">
                                @if ($postData->liked == "no")<i class="fa-regular fa-heart text-danger like-hover"></i>
                                @else<i class="fa-solid fa-heart text-danger like-hover"></i>
                                @endif
                            </a>
                            {{$postData->likes}}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class=" d-flex justify-content-center">
            <div class=" w-25">
                <hr class="bg-white">
            </div>
            <div class=" w-25 ">
                <hr class='bg-white'>
            </div>
            <a href="{{route('user#angel')}}" class=" shadow-lg btn bg-white hover border"><i class="fa-solid fa-heart text-danger"></i> Angels Posts</a>
        </div>
    @endif
    <hr>
    <div class="d-flex justify-content-center my-3">
        <h1 class=" text-white" style="text-shadow: 2px 2px 10px black;text-decoration:underline;">Our Veterinarians</h1>
    </div>
    <div class=" container-fluid">
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