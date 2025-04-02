<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Octoverse</title>
    <link rel="icon" type="image/png" href="{{ asset('img/10-img.png') }}" class="w-6">
    <link rel="stylesheet" href="{{asset('css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>

<body class="">
    <!-- <div class="octoverse-container pc tablet sp"> -->

    <!-- </div> -->
    <div class="sec-login">
        <div>
            <div class="octo-container sp tablet">
                <img src="{{ asset('img/01-logo.png') }}" alt="octoverse logo" class="octo-logo">
            </div>
            <section class="login">
                <form action="{{ route('login') }}" method="post" class="log-form">
                    @csrf
                    <div class="img-container">
                        <img src="{{ asset('img/10-img.png') }}" alt="octoverse logo" class="octoverse-img">
                    </div>
                    <div class="input-gp">
                        <div class="input-box">
                            <input type="email" name="email" class="input @error('email') is-invalid @enderror" placeholder="Enter Your Email Address" value="{{ @old('email') }}">
                            <p class="text-danger">{{ $errors->first('email') }}</p>
                        </div>
                        <div class="input-box">
                            <input type="password" name="password" id="password" class="input @error('password') is-invalid @enderror" placeholder="Enter Your Password">
                            <p class="text-danger">{{ $errors->first('password') }}</p>
                        </div>
                        <div class="input-box">
                            <a href="{{ route('password.request') }}" class="forgot-password">Forgot Password?</a>
                        </div>
                        <div class="input-box">
                            <button type="submit" class="submit">Sign In</button>
                        </div>
                        <p class="or">OR</p>
                        <a href="{{route('register')}}" class="create">Create an New Account</a>
                    </div>
                </form>
            </section>
        </div>
    </div>
    <script src="{{asset('js/libary/jquery.min.js')}}"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{asset('js/libary/toastr.min.js')}}"></script>
</body>

</html>
