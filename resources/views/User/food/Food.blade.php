@extends('User.layout.master')
@section('title','Food')
@section('myContent')

<div class="container-fluid" style=" padding-top:90px;">
    <div class="row d-flex justify-content-center mb-4">
        <div class=" form-control text-center h-50 align-self-center" style="width: 300px">
            <form action="{{route('user#search',['table'=>'food'])}}" method="GET">
                @csrf
                <button class=" border-0" for="search"><i class="fa-solid fa-magnifying-glass hover"></i></button>
                <input type="text" name="search" id="search" class=" ps-1" style="border: none;width:250px;" placeholder="  Search Food  ">
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-10 offset-1">
            @if (($items->count() == null))
                <div class=" d-flex justify-content-center align-items-center" style="height:60vh">
                    {{-- <div class="offset-4 col-4"> --}}
                        <h1 class=" text-black-50">Empty</h1>
                    {{-- </div> --}}
                </div>
            @else
                <div class=" d-flex flex-wrap justify-content-center" >
                    @foreach ($items as $item)
                    <form action="{{route('user#addToCart',['id'=>$item['id'],'type'=>'food'])}}" method="POST" class="">
                        @csrf
                        <div class=" ms-3 mb-3">
                            <div class="card" style="width: 14rem;">
                                <img src="{{asset('storage/'.$item['photo'])}}" class="card-img-top m-auto" alt="..." style="width:200px;height:200px;overflow:hidden;object-fit:contain">
                                <div class="card-body">
                                    <hr>
                                    <h5 class="card-title">{{$item['name']}}</h5>
                                    <p class="card-text" style="height: 80px;overflow:auto;">{{Str::limit($item['detail'],60)}}</p>
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
                {{$items->links()}}
            @endif
                
        </div>
    </div>
</div>
@endsection
