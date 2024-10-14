<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Octoverse | Register</title>
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>

<body class="sec-login">
    <section class="login">
        <form name="regform" method="post" action="{{route('register')}}" class="log-form">
            @csrf
            <div class="img-container">
                <img src="{{ asset('img/10-img.png') }}" alt="octoverse logo" class="octoverse-img">
            </div>
            <div class="input-gp">
                <div class="input-box">
                    <label for="name" class="ttl">Company Name</label>
                    <input type="text" id="name" class="input" name="name" placeholder="Enter Company Name" value="{{ @old('name') }}">
                    <span class="text-danger">{{ $errors->first('name') }}</span><br>
                </div>

                <div class="input-box">
                    <label for="email" class="ttl">Email</label>
                    <input type="email" id="email" class="input" name="email" placeholder="Enter Your Email Address" value="{{ @old('email') }}">
                    <span class="text-danger">{{ $errors->first('email') }}</span><br>
                </div>

                <div class="input-box">
                    <label for="password" class="ttl">Password</label>
                    <input type="password" id="password" class="input" name="password" placeholder="Enter Your Password">
                    <span class="text-danger">{{ $errors->first('password') }}</span><br>
                </div>

                <div class="input-box">
                    <label for="comfirm-pwd" class="ttl">Comfirm Password</label>
                    <input type="password" id="comfirm-pwd" class="input" name="password_confirmation" placeholder="Comfirm Your Password">
                    <span class="text-danger">{{ $errors->first('password') }}</span><br>
                </div>
                <div class="input-box">
                    <button class="submit" name="submit">Register</button>
                </div>
            </div>  
        </form>
        </div>
</body>
</html>