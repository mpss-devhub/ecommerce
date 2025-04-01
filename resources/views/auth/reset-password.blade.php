@extends('layouts.frontend.master')

@section('content')
<div class="main-container">
    <div class="card">
        <h2 class="title">Reset Password</h2>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Email Input -->
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" required autofocus />
            </div>

            <!-- New Password Input -->
            <div class="form-group">
                <label for="password">New Password</label>
                <input id="password" type="password" name="password" required />
            </div>

            <!-- Confirm Password Input -->
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required />
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit">Reset Password</button>
            </div>
        </form>
    </div>
</div>
@endsection
