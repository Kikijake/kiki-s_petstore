@extends('User.layout.master')
@section('title','BuyPage')
@section('myContent')
    <div style="padding-top:90px;" class=" d-flex align-items-center justify-content-center">
        <div class="container-fluid">
            <div class="row mt-2">
                <div class=" offset-2 col-8">
                    <div class="form-control">
                        <form action="{{route('user#order')}}" method="POST">
                            <div class="row">
                                @csrf
                                <div class=" offset-1 col-5">
                                    <div class="mt-3">
                                        <b for="" class=" color-theme">Name</b>
                                        <input type="text" name="name" class=" form-control w-75" value="{{old('name',Auth::user()->name)}}">
                                    </div>
                                    <div class="mt-3">
                                        <b for=""  class=" color-theme">Phone</b>
                                        <input type="text" name="phone" class=" form-control w-75" value="{{old('name',Auth::user()->phone)}}">
                                    </div>
                                    <div class="mt-3">
                                        <b for=""  class=" color-theme">Address</b>
                                        <input type="text" name="address" class=" form-control w-75" value="{{old('name',Auth::user()->address)}}">
                                    </div>
                                    <div class="mt-3">
                                        <b for=""  class=" color-theme">Special Note</b>
                                        <textarea name="note" id="" cols="10" rows="5" class=" form-control w-75"></textarea>
                                    </div>
                                </div>
                                <div class="col">
                                    <h3>Total Amount</h3>
                                    <hr>
                                    <div class="row text-center">
                                        <div class="col-4"><p><b>Item</b></p></div>
                                        <div class="col-4"><p><b>Quantity</b></p></div>
                                        <div class="col-4"><p><b>Amount</b></p></div>
    
                                    </div>
                                    @foreach ($datas as $data)
                                        <div class="row">
                                            <div class=" offset-1 col-3"><p>{{$data['name']}}</p></div>
                                            <div class="col-4 text-center"><p>{{$data['quantity']}}</p></div>
                                            <div class="col-4 text-center"><p>MMK {{$data['price']*$data['quantity']}}</p></div>
                                        </div>
                                    @endforeach
                                    <hr>
                                    <div class="row text-center">
                                        <div class="col-8"><p><b>Total</b></p></div>
                                        <div class="col-4"><p><b>MMK {{$total}}</b></p></div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="d-flex justify-content-between">
                                            <button href="" class=" btn bg-theme w-25 shadow-lg text-white">confirm</button>
                                            <a href="{{route('user#cartPage')}}" class=" btn bg-theme w-25 shadow-lg text-white">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection