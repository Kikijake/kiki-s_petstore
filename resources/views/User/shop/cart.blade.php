@extends('User.layout.master')
@section('title','purchase')
@section('myContent')
<div style="padding-top:90px;" class=" d-flex align-items-center justify-content-center">
    <div class="container-fluid">
        <div class="row mt-2">
            <div class=" offset-2 col-8">
                <div class="form-control">
                    <div class="row">
                        @if ($datas == "empty")
                        <div class=" d-flex justify-content-center align-items-center">
                            <h3>No Item In The Cart</h3>
                        </div>
                        @else
                            <div class="col-7">
                                @foreach ($datas as $data)
                                    <div class="row border pb-2">
                                        <img src="{{asset('storage/'.$data['photo'])}}" class="card-img-top col-2" alt="..." style="width:200px;height:200px;overflow:hidden;object-fit:contain">
                                        <div class="col offset-2">
                                            <h3>{{$data['name']}}</h3>
                                            <p>{{$data['detail']}}</p>
                                            <b id="price">MMK {{$data['price']*$data['quantity']}}</b>
                                            <div class="number-input mt-2">
                                                {{-- <button class="decrement btn" onclick="decrease(this)"><i class="fa-solid fa-minus"></i></button> --}}
                                                <a class="decrement btn" href="{{route('user#decreaseCart',['cartId'=>$data['cartId']])}}"><i class="fa-solid fa-minus"></i></a>
                                                <input type="number" name="quantity" class="quantity" value="{{$data['quantity']}}" max="{{$data['stock']}}">
                                                <a class="decrement btn" href="{{route('user#increaseCart',['id'=>$data['id'],'cartId'=>$data['cartId']])}}"><i class="fa-solid fa-plus"></i></a>
                                                {{-- <button class="increment btn" onclick="increase(this)"><i class="fa-solid fa-plus"></i></button> --}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col">
                                <h3>Total Amount</h3>
                                <hr>
                                <div class="row ">
                                    <div class="col-4 text-center"><p><b>Item</b></p></div>
                                    <div class="col-4 text-center"><p><b>Quantity</b></p></div>
                                    <div class="col-4"><p><b>Amount</b></p></div>

                                </div>
                                @foreach ($datas as $data)
                                    <div class="row">
                                        <div class=" offset-1 col-3"><p>{{$data['name']}}</p></div>
                                        <div class="col-4 text-center"><p>{{$data['quantity']}}</p></div>
                                        <div class="col-4"><p>MMK {{$data['price']*$data['quantity']}}</p></div>
                                    </div>
                                @endforeach
                                <hr>
                                <div class="row text-center">
                                    <div class="col-8"><p><b>Total</b></p></div>
                                    <div class="col-4"><p><b>MMK {{$total}}</b></p></div>
                                </div>
                                <div class="row">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{route('user#buyPage')}}" class=" btn bg-theme w-25 shadow-lg text-white">Buy</a>
                                        <a href="{{route('user#clearCart')}}" class=" btn bg-theme w-25 shadow-lg text-white">Clear Cart</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection