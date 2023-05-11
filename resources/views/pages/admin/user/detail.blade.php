@extends('layout.admin.master')

@section('content')
    <div class="flex flex-col gap-[2rem]">
        <div class="flex flex-row items-center justify-between">
            <div class="flex flex-col w-[70%]">
                <div class="flex label_content_product flex-row items-center">
                    <span class="w-1/4 font-bold">
                        User name
                    </span>
                    <span class="content_product">
                        {{ $foundUser->username }}
                    </span>
                </div>
                <div class="flex flex-row label_content_product items-center">
                    <span class="w-1/4 font-bold">
                        Full name
                    </span>
                    <span class="content_product">
                        {{ $foundUser->full_name }}
                    </span>
                </div>
                <div class="flex flex-row label_content_product items-center">
                    <span class="w-1/4 font-bold">
                        Phone number
                    </span>
                    <span class="content_product">
                        {{ $foundUser->phone_number }}
                    </span>
                </div>
                <div class="flex flex-row label_content_product items-center">
                    <span class="w-1/4 font-bold">
                        Gender
                    </span>
                    <span class="content_product uppercase">
                        {{ $foundUser->genderUser->gender_name }}
                    </span>
                </div>
                <div class="flex flex-row label_content_product items-center">
                    <span class="w-1/4 font-bold">
                        Email
                    </span>
                    <span class="content_product">
                        {{ $foundUser->email }}
                    </span>
                </div>
                <div class="flex flex-row label_content_product items-center">
                    <span class="w-1/4 font-bold">
                        Date of Birth
                    </span>
                    <span class="content_product">
                        {{ $foundUser->date_of_birth }}
                    </span>
                </div>
                <div class="flex flex-row label_content_product items-center">
                    <span class="w-1/4 font-bold">
                        Status user
                    </span>
                    <span class="content_product uppercase">
                        {{ $foundUser->statusUser->status_user }}
                    </span>
                </div>
            </div>
            <div class="flex flex-col items-center w-[28%] justify-center">
                <img width="70%" src="{{ asset('storage/profile_image/Test.jpeg') }}" alt="" class="image_user">
            </div>
        </div>
        <div class="flex flex-col items-center justify-center">
            <a role="button" href="{{ route('admin.user.list') }}" class="button-action w-1/4 rounded font-bold text-center">
                <span>
                    OK
                </span>
            </a>
        </div>
    </div>

@endsection
