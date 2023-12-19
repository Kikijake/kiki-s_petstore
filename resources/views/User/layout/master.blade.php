<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/user/master.css')}}">
</head>
<body>

    {{-- Nav Bar --}}
    <nav class="container-fluid nav" style="height: 70px;width:100%">

        <div class="row">
            <div class="col-1 navigation">
                <div class="row" style=>

                    {{-- Menu --}}
                    <div class="col-1 p-0 menu">

                        <div class="mt-2 text-center" style="width: 100%;">
                            <label for="menu" class="btn" style="font-size: 30px;"><i class="fa-solid fa-bars hover"></i></label>
                        </div>

                        <input type="checkbox" name="" id="menu">
                        <div class="menu-dropdown">
                            <ul class=" list-unstyled">
                                <li><a href="{{route('home')}}" class="btn text-white hover"><i class="fa-solid fa-house"></i> Home</a></li>
                                <li><a href="{{route('user#angel')}}" class="btn text-white hover"><i class="fa-solid fa-heart"></i> Angels</a></li>
                                <li>
                                    <div class="dropdown">
                                        <button class="btn text-white dropdown-toggle hover" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-bone"></i> Food
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item hover" href="{{route('user#food','all')}}"><i class="fa-solid fa-border-all"></i> All</a></li>
                                            <li><a class="dropdown-item hover" href="{{route('user#food','dog')}}"><i class="fa-solid fa-dog"></i> Dog</a></li>
                                            <li><a class="dropdown-item hover" href="{{route('user#food','cat')}}"><i class="fa-solid fa-cat"></i> Cat</a></li>
                                            <li><a class="dropdown-item hover" href="{{route('user#food','bird')}}"><i class="fa-solid fa-dove"></i> Bird</a></li>
                                            <li><a class="dropdown-item hover" href="{{route('user#food','aquatic')}}"><i class="fa-solid fa-fish-fins"></i>Aquatic</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown">
                                        <button class="btn text-white dropdown-toggle hover" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-toilet"></i> Acessories
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item hover" href="{{route('user#accessory','all')}}"><i class="fa-solid fa-border-all"></i> All</a></li>
                                            <li><a class="dropdown-item hover" href="{{route('user#accessory','dog')}}"><i class="fa-solid fa-dog"></i> Dog</a></li>
                                            <li><a class="dropdown-item hover" href="{{route('user#accessory','cat')}}"><i class="fa-solid fa-cat"></i> Cat</a></li>
                                            <li><a class="dropdown-item hover" href="{{route('user#accessory','bird')}}"><i class="fa-solid fa-dove"></i> Bird</a></li>
                                            <li><a class="dropdown-item hover" href="{{route('user#accessory','aquatic')}}"><i class="fa-solid fa-fish-fins"></i>Aquatic</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="{{route('user#vetPageUser')}}" class="btn text-white hover"><i class="fa-solid fa-house-chimney-medical"></i> Veterinarian</a></li>
                                <li><a href="{{route('user#aboutUs')}}" class="btn text-white hover"><i class="fa-solid fa-circle-info"></i> About Us</a></li>

                            </ul>
                        </div>

                    </div>
                    {{-- End Menu --}}

                    {{-- Logo --}}
                    <img src="{{asset('image/NavBar/PetStoreLogo.png')}}" alt="" class=" logo col-2 align-self-center h-100" height="60px">
                    {{-- End Logo --}}

                    {{-- Left Nav --}}
                    <div class=" col-3 pt-4 left-nav" >
                        <ul class=" list-unstyled d-flex justify-content-evenly">
                            <li><a href="{{route('home')}}" class=" hover"><i class="fa-solid fa-house"></i> Home</a></li>
                            <li><a href="{{route('user#vetPageUser')}}" class=" hover"><i class="fa-solid fa-house-chimney-medical"></i> Veterinarian</a></li>
                            <li><a href="{{route('user#aboutUs')}}" class=" hover"><i class="fa-solid fa-circle-info"></i> About Us</a></li>
                        </ul>
                    </div>
                    {{-- End Left Nav --}}

                    {{-- Nav Photo Banner --}}
                    <div class="col-3 nav-banner" style="height: 70px;">
                        <div class="row">
                            <div class=" d-flex justify-content-between">
                                <img src="{{asset('image/NavBar/WalkingDog.svg')}}" alt="" class="col-4" height="60px">
                                <img src="{{asset('image/NavBar/WelcomeCat.svg')}}" alt="" class="col-4" height="60px">
                                <img src="{{asset('image/NavBar/SittingCat.svg')}}" alt="" class="col-4" height="60px">
                            </div>
                        </div>
                    </div>
                    {{-- End Nav Photo Banner --}}

                    {{-- Right Nav --}}
                    <div class=" col-2 pt-4 right-nav">
                        <ul class=" list-unstyled d-flex justify-content-evenly">
                            <li><a href="{{route('user#angel')}}" class=" hover"><i class="fa-solid fa-heart"></i> Angels</a></li>
                            <li><a href="#Contact-Us" class=" hover"><i class="fa-solid fa-address-card"></i> Contact Us</a></li>
                        </ul>
                    </div>
                    {{-- End Right Nav --}}


                </div>
            </div>

            {{-- Profile --}}
            {{-- <div class="col pt-3 profile d-flex justify-content-end" style="height: 60px;">
                <img src="{{asset('image/Default_User.jpg')}}" alt="">
            </div> --}}

            <div class="dropdown col pt-3 profile d-flex justify-content-end" style="height: 60px;">
                <button class="btn hover-img" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                    <img src="@if (!empty(Auth::user()))
                        {{asset('storage/'.Auth::user()->photo)}}
                        @else
                        {{asset('image/Default_User.jpg')}}
                        @endif" alt="" style="height:30px;width:30px;border-radius: 100%;object-fit:cover; overflow:hidden;">

                </button>
                <ul class="dropdown-menu">
                    @if (empty(Auth::user()))
                    <li>
                        <a href="{{route('loginPage')}}" class="dropdown-item hover"> <i class="fa-solid fa-user"></i> Login</a>
                    </li>
                    <li>
                        <a href="{{route('registerPage')}}" class="dropdown-item hover"> <i class="fa-solid fa-address-card"></i> Register</a>
                    </li>
                    @else
                    <li>
                        <div class="dropdown-item"> <i class="fa-solid fa-user"></i> {{Auth::user()->name}} </div>
                    </li>
                    <li>
                        <div class="dropdown-item"> <i class="fa-solid fa-phone"></i> {{Auth::user()->phone}} </div>
                    </li>
                    <hr>
                    <li>
                        <a href="{{route('user#profileEdit')}}" class=" dropdown-item hover"> <i class="fa-solid fa-pen"></i> Edit Profile</a>
                    </li>
                    <li>
                        <a href="{{route('user#orderHistory')}}" class=" dropdown-item hover"><i class="fa-solid fa-scroll"></i> Order History</a>
                    </li>
                    <li>
                        <a href="{{route('user#cartPage')}}" class=" dropdown-item hover"><i class="fa-solid fa-cart-shopping"></i> Cart</a>
                    </li>
                    <li>
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item hover"><i class="fa-solid fa-right-from-bracket"></i> Logout</button>
                        </form>
                    </li>
                    @endif
                </ul>
              </div>
            {{-- End Profile --}}
        </div>
    </nav>
    @yield('myContent')
    <div style="width: 100%;height:20px;background-color:white;margin-top:20px"></div>
    <div class="banner-context">
        <div id="carouselExample" class="carousel slide h-100 w-100">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://wallpaperset.com/w/full/a/e/9/421435.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://www.st-pop.com.au/cdn/shop/products/SP-0002681PT-0006081MDL-4000px.jpg?v=1678148601" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://www.hdnicewallpapers.com/Walls/Big/Parrot/Blue_and_Yellow_Parrot_HD_Wallpaper.jpg" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div style="width: 100%;height:20px;background-color:white;"></div>

    <footer>
        <div class="container-fluid">
            <div class="row bg-dark text-white">
                <div class="col-10 offset-1">
                    <div class="row pt-4 mb-4">
                        <div class="col-5">
                            <h4>About Us</h4>
                        </div>
                        <div class="col-2 offset-2">
                            <h4 class=" ms-3">Shop</h4>
                            <ul class=" list-unstyled mt-5">
                                <li class="">
                                    <div class="dropdown">
                                        <button class="btn text-white dropdown-toggle hover" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-bone"></i> Food
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item hover" href="{{route('user#food','all')}}"><i class="fa-solid fa-border-all"></i> All</a></li>
                                            <li><a class="dropdown-item hover" href="{{route('user#food','dog')}}"><i class="fa-solid fa-dog"></i> Dog</a></li>
                                            <li><a class="dropdown-item hover" href="{{route('user#food','cat')}}"><i class="fa-solid fa-cat"></i> Cat</a></li>
                                            <li><a class="dropdown-item hover" href="{{route('user#food','bird')}}"><i class="fa-solid fa-dove"></i> Bird</a></li>
                                            <li><a class="dropdown-item hover" href="{{route('user#food','aquatic')}}"><i class="fa-solid fa-fish-fins"></i>Aquatic</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="">
                                    <div class="dropdown">
                                        <button class="btn text-white dropdown-toggle hover" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-toilet"></i> Acessories
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item hover" href="{{route('user#accessory','all')}}"><i class="fa-solid fa-border-all"></i> All</a></li>
                                            <li><a class="dropdown-item hover" href="{{route('user#accessory','dog')}}"><i class="fa-solid fa-dog"></i> Dog</a></li>
                                            <li><a class="dropdown-item hover" href="{{route('user#accessory','cat')}}"><i class="fa-solid fa-cat"></i> Cat</a></li>
                                            <li><a class="dropdown-item hover" href="{{route('user#accessory','bird')}}"><i class="fa-solid fa-dove"></i> Bird</a></li>
                                            <li><a class="dropdown-item hover" href="{{route('user#accessory','aquatic')}}"><i class="fa-solid fa-fish-fins"></i>Aquatic</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-3" id="Contact-Us">
                            <h4>Contact Us</h4>
                            <ul class=" list-unstyled mt-5">
                                <li class=" mb-2"><i class="fa-solid fa-phone"></i> {{App\Models\User::where('name','MainAdmin')->first()->phone}}</li>
                                <li class=" mb-2"><i class="fa-brands fa-viber"></i> {{App\Models\User::where('name','MainAdmin')->first()->phone}}</li>
                                <li class=" mb-2"><i class="fa-solid fa-envelope"></i> {{App\Models\User::where('name','MainAdmin')->first()->email}}</li>
                                <li class=" mb-2"><i class="fa-brands fa-square-facebook"></i> KiKi's PetStore</li>
                                <li class=" mb-2"><a href="{{route('user#message')}}" class="" style="text-decoration: underline"><i class="fa-solid fa-square-up-right"></i> Contact Directly</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row bg-theme">
                        <div class="col-8 offset-2 text-center">
                            <img src="{{asset('image/NavBar/PetStoreLogo.png')}}" alt="" class=" object-cover w-100">
                            <div class="">
                                <p>Copyright © 2021 Kiki'sPetStore Mauritius. All rights reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script> --}}

</html>
