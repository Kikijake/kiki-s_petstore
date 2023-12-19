<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- BootStrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous"> --}}
    {{-- End BootStrap --}}

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- End FontAwesome --}}
    <link rel="stylesheet" href="{{asset('css/admin/master.css')}}">
    <title>@yield('title')</title>
    <link rel="icon" href="{{asset('image/PetStoreicon.png')}}" type="image/x-icon">
</head>
<body>
    <div class="container-fluid">
        <div class="row">

            {{-- Left Tab --}}
            <div class="col-2 left-tab">

                {{-- Logo --}}
                <div class="logo">
                    <img src="{{asset('image/NavBar/PetStoreLogo.png')}}" alt="Logo">
                </div>
                {{-- End Logo --}}
                <hr>
                
                <div>
                    <ul class=" list-unstyled">
                        <li>
                            <a href="{{route('admin#home')}}" class="btn hover"><i class="fa-solid fa-house"></i> Home Page</a>
                        </li>

                        <li >
                            {{-- Saved Animals --}}
                            <a href="{{route('admin#angelPage')}}" class="btn hover"><i class="fa-solid fa-heart"></i> Angels</a>
                        </li>
                        <li >
                            {{-- Saved Animals --}}
                            <a href="{{route('admin#orderPage')}}" class="btn hover"><i class="fa-solid fa-scroll"></i> Order List</a>
                        </li>
                        <li>
                            <div class="dropdown">
                                <button class="btn hover dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-bone"></i> Food
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item hover" href="{{route('admin#food','all')}}"><i class="fa-solid fa-folder-open"></i> All</a></li>
                                    <li><a class="dropdown-item hover" href="{{route('admin#food','dog')}}"><i class="fa-solid fa-dog"></i> Dog</a></li>
                                    <li><a class="dropdown-item hover" href="{{route('admin#food','cat')}}"><i class="fa-solid fa-cat"></i> Cat</a></li>
                                    <li><a class="dropdown-item hover" href="{{route('admin#food','bird')}}"><i class="fa-solid fa-dove"></i> Bird</a></li>
                                    <li><a class="dropdown-item hover" href="{{route('admin#food','aquatic')}}"><i class="fa-solid fa-fish-fins"></i> Aquatic</a></li>
                                </ul>
                              </div>
                        </li>
                        <li>
                            <div class="dropdown">
                                <button class="btn hover dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-toilet"></i> Accessories
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item hover" href="{{route('admin#accessory',['type'=>'all'])}}"><i class="fa-solid fa-folder-open"></i> All</a></li>
                                    <li><a class="dropdown-item hover" href="{{route('admin#accessory',['type'=>'dog'])}}"><i class="fa-solid fa-dog"></i> Dog</a></li>
                                    <li><a class="dropdown-item hover" href="{{route('admin#accessory',['type'=>'cat'])}}"><i class="fa-solid fa-cat"></i> Cat</a></li>
                                    <li><a class="dropdown-item hover" href="{{route('admin#accessory',['type'=>'bird'])}}"><i class="fa-solid fa-dove"></i> Bird</a></li>
                                    <li><a class="dropdown-item hover" href="{{route('admin#accessory',['type'=>'aquatic'])}}"><i class="fa-solid fa-fish-fins"></i>Aquatic</a></li>
                                </ul>
                              </div>
                        </li>
                        <li>
                            <a href="{{route('admin#vetPage')}}" class="btn hover"><i class="fa-solid fa-house-chimney-medical"></i> Veterinarian</a>

                        </li>
                        <li>
                            <a href="{{route('admin#aboutUs')}}" class="btn hover"><i class="fa-solid fa-circle-info"></i> About Us</a>

                        </li>

                    </ul>
                </div>

                
            </div>
            {{-- End Left Tab --}}

            {{-- Nav Bar --}}
            <div class="col-10 p-0 right-tab">
                <nav class=" container-fluid bg-theme" style="height: 10vh;">
                    <div class="h-100 d-flex align-items-center justify-content-between">
                        <h1 class=" text-white">@yield('pageName')</h1>
                        <div class=" d-flex justify-content-end h-100">
                            @yield('search')
                            <ul class="nav-btn list-unstyled d-flex justify-content-evenly align-items-center h-100 ms-5" style="width: 350px">
                                <li class=" hover">
                                    <div class="dropdown">
                                        <button class="btn hover dropdown-toggle text-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-regular fa-bell"></i> Notification
                                        </button>
                                        <ul class="dropdown-menu" style="max-height: 300px;overflow:auto;">
                                            <div class=" d-none">
                                                {{
                                                    $notis = App\Models\Notification::orderBy('id','desc')->get();
                                                }}
                                            </div>
                                            @foreach ($notis as $noti)
                                                <li>
                                                    <a class="dropdown-item hover bg-theme @if ($noti->seen == "yes")
                                                        bg-light
                                                    @endif" href="{{route('admin#checkNoti',[$noti->id])}}">
                                                        <b>{{$noti->user}}</b>
                                                        <p>{{$noti->message}}</p>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                      </div>
                                </li>
                                <li ><a href="{{route('admin#message',['user'=>'latest'])}}" class=" hover"><i class="fa-regular fa-message"></i> Message</li></a>
                                {{-- Profile --}}
                                <li class=" profile">
                                    <div class="dropdown">
                                        <button class="btn hover-img" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                          <img src="{{asset('storage/'.Auth::user()->photo)}}" class="hover-img" alt="">
                                        </button>
                                        <ul class="dropdown-menu">
                                          @if (Auth::user()->email == 'kikipetstore@gmail.com')
                                          <li><a class="dropdown-item hover" href="{{route('admin#register')}}">Create Account</a></li>
                                          @endif
                                          <li ><a href="{{route('admin#profileEdit')}}" class=" dropdown-item hover">Edit Profile</a></li>
                                          <li>
                                            <form action="{{route('logout')}}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item hover">Logout</button>
                                            </form>
                                          </li>
                                        </ul>
                                    </div>
                                </li>
                                {{-- End Profile --}}
                            </ul>
                        </div>

                    </div>
                </nav>
                <div class="content">
                    @yield('content')
                </div>
            </div>
            {{-- End Nav Bar --}}
        </div>
    </div>
</body>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script> --}}

</html>