@extends('User.layout.master')
@section('title','About Us')
@section('myContent')
<div class="container-fluid" style=" padding-top:90px;">
    <div class="row">
        <div class="col-6 offset-3">
            <div class="row">
                <div class="card border-color-theme">
                    <h2 class=" card-header">@if (isset($data)){{$data->header}}@endif</h2>
                    <p class=" card-body">@if (isset($data)){{$data->aboutUs}}@endif</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection