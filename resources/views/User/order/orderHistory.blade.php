@extends('User.layout.master')
@section('title','Order History')
@section('myContent')

    @if ($lists == [])
    <div class="container-fluid" style=" padding-top:90px;">
        <div class="row">
            <div class="col-10 offset-1">
                <div class=" d-flex justify-content-center align-items-center" style="height:60vh">
                    <div>
                        <h1 class=" text-black-50">No History</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
        <div style="padding-top:90px;" class=" d-flex align-items-center justify-content-center">
            <div class=" container-fluid my-5">
                <div class="row">
                    <div class="col-8 offset-2">
                        <div class="row">
                            <div class=" form-control">
                                @foreach ($lists as $list)
                                    <div class=" @if ($list['orderBy']->process == 'cancel')
                                        text-black-50 
                                    @endif row m-1 p-1 border border-2">
                                        <div class=" col-5 offset-1">
                                            <div class=" d-flex">
                                                <h1>#{{$list['orderBy']->id}}</h1>
                                                @if ($list['orderBy']->process == 'cancel')
                                                    <b class=" text-danger ms-2">( Canceled )</b>
                                                @elseif ($list['orderBy']->process == 'done')
                                                    <b class=" text-success ms-2">( Delievered )</b>
                                                @endif
                                            </div>
                                            <div class=" card p-3">
                                                <b>Name</b>
                                                <div> {{$list['orderBy']->name}}</div>
                                                <b>Phone</b>
                                                <div> {{$list['orderBy']->phone}} </div>
                                                <b>Address</b>
                                                <div> {{$list['orderBy']->address}} </div>
                                                <b>Customer's Note</b>
                                                <div class=""> " {{$list['orderBy']->note}} " </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="row text-center">
                                                <div class="col-4"><p><b>Item</b></p></div>
                                                <div class="col-4"><p><b>Quantity</b></p></div>
                                                <div class="col-4"><p><b>Amount</b></p></div>
                                            </div>
                                            @foreach ($list['orders'] as $order)
                                                <div class="row">
                                                    <div class=" offset-1 col-3"><p>{{$order['name']}}</p></div>
                                                    <div class="col-4 text-center"><p>{{$order['quantity']}}</p></div>
                                                    <div class="col-4 text-center"><p>MMK {{$order['amount']}}</p></div>
                                                </div>
                                            @endforeach
                                            <hr>
                                            <div class="row text-center">
                                                <div class="col-8"><p><b>Total</b></p></div>
                                                <div class="col-4"><p><b>MMK {{$list['total']}}</b></p></div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection