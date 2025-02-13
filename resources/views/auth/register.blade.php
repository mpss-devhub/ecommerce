<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Octoverse</title>
    <link rel="icon" type="image/png" href="{{ asset('img/10-img.png') }}" class="w-6">
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/registration.css')}}">
</head>

<body class="register">
    <section class="reg">
        <form name="regform" method="post" action="{{route('register')}}" class="reg-form">
            @csrf
            <div class="img-container">
                <img src="{{ asset('img/10-img.png') }}" alt="octoverse logo" class="octoverse-img">
            </div>
            <div class="input-group">
                <div class="input-box">
                    <label for="name" class="label">Company Name</label>
                    <input type="text" id="name" class="input" name="name" placeholder="Enter Company Name" value="{{ @old('name') }}">
                    <span class="text-danger" style="margin-bottom: 10px; margin-top: 0;">{{ $errors->first('name') }}</span>
                </div>

                <div class="input-box">
                    <label for="email" class="label">Email</label>
                    <input type="email" id="email" class="input" name="email" placeholder="Enter Your Email Address" value="{{ @old('email') }}">
                    <span class="text-danger" style="margin-bottom: 10px; margin-top: 0;">{{ $errors->first('email') }}</span>
                </div>

                <div class="input-box">
                    <label for="password" class="label">Password</label>
                    <input type="password" id="password" class="input" name="password" placeholder="Enter Your Password">
                    <span class="text-danger" style="margin-bottom: 10px; margin-top: 0;">{{ $errors->first('password') }}</span>
                </div>

                <div class="input-box">
                    <label for="comfirm-pwd" class="label">Comfirm Password</label>
                    <input type="password" id="comfirm-pwd" class="input" name="password_confirmation" placeholder="Comfirm Your Password">
                    <span class="text-danger" style="margin-bottom: 10px; margin-top: 0;">{{ $errors->first('password') }}</span>
                </div>
                <div class="input-box">
                    <button class="btn-submit" name="submit">Register</button>
                </div>
                <div class="input-box login-txt">
                    <p>Already have an account? <a href="/login"> login</a></p>
                </div>
            </div>
        </form>
        </div>
</body>

</html>