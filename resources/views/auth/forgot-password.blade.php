@extends('layouts.frontend.master')

@section('content')

<div class="main-container">
    <div class="card">
        <div>
            <img src="{{ asset('img/10-img.png') }}" alt="Logo">
        </div>
        <div>
            <p class="eng-text">
                This website is a demo website that has been tested to understand the sample payment flow of Octoverse
                Payment Gateway. Please be informed that if you purchase items from this website, you will not actually
                receive the item, but your bank account will be charged for the value of the item.
            </p>
        </div>
        <hr>
        @if(session('status'))
        <div id="myModal" class="modal">
            <div class="modal-content">
                <div class="close-btn">
                    <span class="close" onclick="closeModal()">&times;</span>
                </div>
                <p>{{ session('status') }}</p>
            </div>
        </div>
        @endif

        <div class="form-container">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div>
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" class="input @error('email') is-invalid @enderror" required autofocus />
                    <p class="text-danger" style="margin-top: -10px;">{{ $errors->first('email') }}</p>
                </div>
                <div class="button-container">
                    <button class="btn-submit" name="submit">Email Password Reset Link</button>
                </div>
            </form>
        </div>

    </div>
</div>
<script>
    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }
</script>

@endsection
