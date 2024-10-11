<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Octoverse | Register</title>
  <link rel="stylesheet" href="{{asset('css/common.css')}}">
  <link rel="stylesheet" href="{{asset('css/registration.css')}}">
</head>
<body>
  <div class="l-inner">  
    
    <div class="reg">
      <form name="regform" method="post" action="{{route('register')}}">
      @csrf
        <h2 class="reg-h2">Sign Up</h2>  
        <div class="input-gp">
          <div class="input-box">
            <label for="name">Name</label>
            <input type="text" id="name" class="name" name="name" placeholder="Enter Your Name" value="{{ @old('name') }}">
            <span class="text-danger">{{ $errors->first('name') }}</span><br>
          </div>
          
          <div class="input-box">
            <label for="email">Email</label>
            <input type="email" id="email" class="email" name="email" placeholder="Enter Your Email Address" value="{{ @old('email') }}">
            <span class="text-danger">{{ $errors->first('email') }}</span><br>
          </div>

          <div class="input-box">
            <label for="password">Password</label>
            <input type="password" id="password" class="password" name="password" placeholder="Enter Your Password">
            <span class="text-danger">{{ $errors->first('password') }}</span><br>
          </div>

          <div class="input-box">
            <label for="comfirm-pwd">Comfirm Password</label>
            <input type="password" id="comfirm-pwd" class="comfirm-pwd" name="password_confirmation" placeholder="Comfirm Your Password">
            <span class="text-danger">{{ $errors->first('password') }}</span><br>
          </div>
                    
        </div>
        <div class="btn-gp">
          <button class="btn-submit" name="submit">Register</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
