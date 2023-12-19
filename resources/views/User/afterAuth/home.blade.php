@extends('User.layout.master')

@section('myContent')
    <div class="banner-context">
        <img src="{{asset('storage/'.$dbhome[0]->photo)}}" alt="" class="banner">
        <div class="context">
            <p>
                {{$dbhome[0]->context}}
            </p>
            <form action="">
                <button type="submit" class="btn border-white">Enquire Now</button>
            </form>
        </div>
    </div>
    <div style="width: 100%;height:20px;background-color:white"></div>
@endsection