<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/cart.css')}}">
    <link rel="stylesheet" href="{{asset('css/product.css')}}">
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <link rel="stylesheet" href="{{asset('css/checkout.css')}}">
    <link rel="stylesheet" href="{{asset('fontawesome/all.min.css')}}">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
</head>

<body>
    <header class="sec-header">
        <div class="l-inner clearfix">
            <div class="logo">
                <a href="#">
                    <img src="{{ asset('/img/01-logo.png') }}" alt="logo">
                </a>
            </div>
            <!--logo-->
            <nav class="gnav">
                <ul>
                    <li><a href="/" class="">Home</a></li>
                    <li><a href="/products" class="">Product</a></li>
                    <li>
                        <a href="/cart">
                            <i class="fa-solid fa-cart-shopping"></i>
                            (<span class="cart-count">{{ session()->has('cart') && count(session()->get('cart')) > 0 ? count(session()->get('cart')) : 0 }}</span>)
                        </a>
                    </li>
                </ul>
                </li>
                </ul>
            </nav>
            <!--gnav-->
            <button class="menu-icon">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
        <!--l-inner-->
    </header>
    <!--header-->
    @yield('content')
    <footer class="footer">
        copyright@octoverse 2024
    </footer>
    <!--footer-->

    <script src="{{asset('js/libary/jquery.min.js')}}"></script>
    <script src="{{asset('js/libary/toastr.min.js')}}"></script>
    <script src="{{asset('js/common.js')}}"></script>
    <script src="{{asset('js/cart.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('js')
</body>

</html>
