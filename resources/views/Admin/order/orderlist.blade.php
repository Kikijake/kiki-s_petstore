@extends('Admin.layout.master')
@section('title','Order List')
@section('pageName')
<i class="fa-solid fa-scroll"></i> Order List
@endsection
@section('search')
<div class=" form-control text-center h-50 align-self-center" style="width: 300px">
    <form action="{{route('admin#search',['table'=>'order'])}}" method="GET">
        @csrf
        <button class=" border-0" for="search"><i class="fa-solid fa-magnifying-glass hover"></i></button>
        <input type="text" name="search" id="search" class=" ps-1" style="border: none;width:250px;" placeholder=" Search Orders">
    </form>
</div>
@endsection
@section('content')
    <div class=" container-fluid my-5">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <div class=" form-control">
                        @foreach ($lists as $list)
                            <div class="row m-1 p-1 border border-2 @if ($list['orderBy']->process == 'done')
                                border-success
                            @elseif ($list['orderBy']->process == 'cancel')
                                border-danger
                            @endif ">
                                <div class=" col-5 offset-1">
                                    <div class=" d-flex">
                                        <h1 id="">#{{$list['orderBy']->id}}</h1>
                                        @if ($list['orderBy']->process == 'cancel')
                                            <b class=" text-danger ms-2">( Canceled )</b>
                                        @elseif ($list['orderBy']->process == 'done')
                                            <b class=" text-success ms-2">( Delievered )</b>
                                        @endif
                                    </div>
                                    <b>Name</b>
                                    <div> {{$list['orderBy']->name}}</div>
                                    <b>Phone</b>
                                    <div> {{$list['orderBy']->phone}} </div>
                                    <b>Address</b>
                                    <div> {{$list['orderBy']->address}} </div>
                                    <b>Customer's Note</b>
                                    <div> " {{$list['orderBy']->note}} " </div>
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
                            <div class=" d-flex justify-content-end my-3">
                                <a href="{{route('admin#orderProcessCancel',['id'=>$list['orderBy']->id])}}" class="btn bg-danger me-2 text-white">Cancel</a>
                                <a href="{{route('admin#orderProcessDone',['id'=>$list['orderBy']->id])}}" class="btn bg-theme" >Done</a>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection