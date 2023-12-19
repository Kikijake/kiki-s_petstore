@extends('Admin.layout.master')
@section('title','About Us')
@section('pageName')
<i class="fa-solid fa-circle-info"></i> About Us
@endsection
@section('content')
<div class="container-fluid" style="height: 90vh;overflow:auto;">
    <div class="row mt-3">
        <div class="col-8 offset-2">
            <div class="container">
                <form action="{{route('admin#updateAboutUs')}}" method="POST" class=" form-control" style="height: 80vh;">
                    @csrf
                    <div style="height: 10%;">
                        <b>Header</b>
                        <textarea name="header" id="" cols="30" rows="5" class="w-100 ps-1" style="height: 60%;">@if (isset($data)){{$data->header}}@endif</textarea>
                    </div>
                    <div class="mt-2 w-100 " style="height: 70%;">
                        <b>About Us</b>
                        <textarea name="aboutUs" id="" cols="30" rows="30" class="w-100 ps-1" style="height: 90%;">@if (isset($data)){{$data->aboutUs}}@endif</textarea>
                    </div>
                    <div class=" d-flex justify-content-center w-100" style="height: 15%;">
                        <button class=" btn bg-theme text-white h-50">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection