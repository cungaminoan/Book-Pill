@extends('layout.auth')

@section('content')
<div class="flex flex-row items-center">
    <img class="image_large" src="{{ asset('storage/source_image/large_bookpill.png') }}" alt="">
    <form action="{{ route('request_sign_in') }}" method="POST" class="flex flex-col auth_area">
        @csrf
        <span class="auth-header-text mb-[3rem]">
            Sign in
        </span>
        <input type="text" class="input_auth_username" name="email" placeholder="Email">
        <div class="flex flex-row items-center w-full mb-[2rem]">
            <input type="text" class="w-full input_auth_password" name="password" placeholder="Password">
            <i class="fa-regular fa-eye icon-eye"></i>
        </div>
        <button class="button-action mb-[0.5rem]">
            <span>
                Sign in
            </span>
        </button>
        <div class="flex flex-row items-center mb-[1rem]">
            <a class="text-link" href="{{ route('reset') }}">
                <span>
                    Forgot Password
                </span>
            </a>
        </div>
        <hr class="mb-[1rem]">
        <div class="flex flex-row items-center justify-center">
            <span class="text-link mr-[0.4rem]">
                New to BookPill?
            </span>
            <a href="{{ route('register') }}">
                <span class="text-link-switch">
                    Register
                </span>
            </a>
        </div>
    </form>
</div>
@endsection
