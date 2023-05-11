@extends('layout.auth')

@section('content')
    <div class="flex flex-row items-center justify-center min-h-[600px]">
        <form action="{{ route('register_user_req') }}" method="POST" class="flex flex-col items-center reset-pass-modal">
            @csrf
            <div class="flex flex-row justify-center pb-[32px]">
                <span class="title-reset-pass">
                    Register User
                </span>
            </div>

            <div class="flex flex-col w-3/4 gap-[16px]">
                <div class="flex flex-row items-center gap-[16px]">
                    <div class="w-[27%] flex flex-row-reverse">
                        <span class="label_content_profile">
                            User name
                        </span>
                    </div>
                    <input type="text" class="w-[75%] mb-[0] input_auth_username" name="username">
                </div>
                <div class="flex flex-row items-center gap-[16px]">
                    <div class="w-[27%] flex flex-row-reverse">
                        <span class="label_content_profile">
                            Full name
                        </span>
                    </div>
                    <input type="text" class="w-[75%] mb-[0] input_auth_username" name="full_name">
                </div>
                <div class="flex flex-row items-center gap-[16px]">
                    <div class="w-[27%] flex flex-row-reverse">
                        <span class="label_content_profile">
                            Phone number
                        </span>
                    </div>
                    <input type="text" class="w-[75%] mb-[0] input_auth_username" name="phone_number">
                </div>
                <div class="flex flex-row items-center gap-[16px]">
                    <div class="w-[27%] flex flex-row-reverse">
                        <span class="label_content_profile">
                            Gender
                        </span>
                    </div>
                    <div class="flex flex-row w-[75%] gap-[1rem] items-center">
                        <div class="form-check form-check-inline flex flex-row items-center gap-[4px]">
                            <input type="radio" value="1" name="gender">
                            <label for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline flex flex-row items-center gap-[4px]">
                            <input type="radio" value="2" name="gender">
                            <label for="female">Female</label>
                        </div>
                        <div class="flex flex-row items-center gap-[4px]">
                            <input  type="radio" value="3" name="gender">
                            <label for="other">Other</label>
                        </div>
                    </div>
                </div>
                <div class="flex flex-row items-center gap-[16px]">
                    <div class="w-[27%] flex flex-row-reverse">
                        <span class="label_content_profile">
                            Date of Birth
                        </span>
                    </div>
                    <input type="date" class="w-[75%] mb-[0] input_auth_username" name="date_of_birth">
                </div>
                <div class="flex flex-row items-center gap-[16px]">
                    <div class="w-[27%] flex flex-row-reverse">
                        <span class="label_content_profile">
                            Password
                        </span>
                    </div>
                    <input type="text" class="w-[75%] mb-[0] input_auth_username" name="password">
                </div>
                <input type="text" value="{{ $email }}" name="email" hidden>
            </div>
            <button class="button-action mt-[16px]">
                <span>
                    Register
                </span>
            </button>
        </form>

    </div>
@endsection
