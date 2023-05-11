@extends('layout.auth')

@section('content')
    <div class="flex flex-row items-center justify-center min-h-[600px]">
        <div class="flex flex-col items-center reset-pass-modal">
            <div class="flex flex-row justify-center pb-[32px]">
                <span class="title-reset-pass">
                    Set your password
                </span>
            </div>
            <form action="{{ route('reset.request') }}" method="POST" class="flex flex-col w-3/4">
                @csrf
                <input type="text" class="w-full input_auth_username" placeholder="Password">
                <button class="button-action">
                        <span>
                            Continue
                        </span>
                </button>
            </form>
        </div>
    </div>
@endsection
