@extends('layouts.frontend.master')

@section('content')
<div class="res-container">
    <div class="res-card">
        <h2 class="title">Reset Password</h2>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Email Input -->
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" class="input @error('email') is-invalid @enderror" required autofocus />
                <p class="text-danger">{{ $errors->first('email') }}</p>
            </div>

            <!-- New Password Input -->
            <div class="form-group">
                <label for="password">New Password</label>
                <input id="password" type="password" name="password" />
                <p class="text-danger">{{ $errors->first('password') }}</p>
            </div>

            <!-- Confirm Password Input -->
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" class="input @error('password') is-invalid @enderror" required />
                <p class="text-danger">{{ $errors->first('password') }}</p>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit">Reset Password</button>
            </div>
        </form>
    </div>
</div>
@endsection
