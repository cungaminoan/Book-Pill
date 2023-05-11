@extends('layout.auth')

@section('content')
<div class="flex flex-row items-center justify-center min-h-[600px]">
    <div class="flex flex-col items-center reset-pass-modal">
        <div class="flex flex-row justify-center pb-[32px]">
                <span class="title-reset-pass">
                    Email Verification
                </span>
        </div>

            <div class="flex flex-col w-3/4">
                <i class="text-center fa-solid fa-paper-plane text-[#566FEF] text-[2.5rem]"></i>
                <span class="text-center pb-[16px] pt-[16px]">
                        A Verification email has been sent to this email address
                        <span class="text-[#566FEF]">
                            {{ $mailaddress }}
                        </span>. Please verify it.
                    </span>
                <a role="button" href="{{ route('sign_in') }}" class="text-center button-action">
                        <span>
                            Ok
                        </span>
                </a>
            </div>
    </div>
</div>
@endsection
