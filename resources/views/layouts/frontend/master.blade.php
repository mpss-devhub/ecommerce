<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Octoverse</title>
    <link rel="icon" type="image/png" href="{{ asset('img/10-img.png') }}" class="w-6">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/history.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
</head>

<body>
    <header class="sec-header">
        <div class="l-inner clearfix">
            <div class="logo">
                <a href="/">
                    <img src="{{ asset('/img/01-logo.png') }}" alt="logo">
                </a>
            </div>
            <!--logo-->
            <nav class="gnav">
                <ul>
                    <li><a href="/" class="">Home</a></li>
                    <li><a href="/products" class="">Product</a></li>
                    <li><a href="/history" class="">History</a></li>
                    <li>
                        <a href="/cart">
                            <i class="fa-solid fa-cart-shopping"></i>
                            (<span
                                class="cart-count">{{ session()->has('cart') && count(session()->get('cart')) > 0 ? count(session()->get('cart')) : 0 }}</span>)
                        </a>
                    </li>
                    @auth
                        <li><a href="{{ url('/logout') }}" class="logout">Logout</a></li>
                    @else
                        <li class="dropdown pc">
                            <button class="dropbtn pc">
                                <i class="fas fa-sign-in-alt signin-icon"></i>
                            </button>
                            <div class="dropdown-content pc">
                                <a href="{{ route('login') }}">Login</a>
                                <a href="{{ route('register') }}"
                                    class="{{ Request::is('/register') ? 'active' : '' }}">Register</a>
                            </div>
                        </li>
                        <li class="  sp">
                            <ul class="list">
                                <li><a href="{{ route('register') }}"
                                        class="{{ Request::is('/register') ? 'active' : '' }}  sp">Register</a></li>
                                <li class="sp"><a href="{{ route('login') }} ">Login</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    </li>
                @endauth
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
    <div class="fixed-banner ">
        <section class="text-white items-center">
            <div class="whitespace-nowrap">
                <div class="animate-scroll">
                    <p class="inline-block mx-2 text-blue-700"> မြန်မာ့နှစ်သစ်ကူး Promotion အဖြစ် Integration Fee 50%
                        Off ကို 01-April-2025 မှ 30-April-2025 အထိ ရယူ ခံစားလိုက်ပါ။ </p>
                </div>
            </div>
        </section>
    </div>

    <!--header-->
    @yield('content')
    <footer class="footer">
        copyright@octoverse 2025
    </footer>
    <!--footer-->

    <script src="{{ asset('js/libary/jquery.min.js') }}"></script>
    <script src="{{ asset('js/libary/toastr.min.js') }}"></script>
    <script src="{{ asset('js/common.js') }}"></script>
    <script src="{{ asset('js/cart.js') }}"></script>
    <script src="{{ asset('js/checkout.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- @stack('js') -->

</body>
</html>
