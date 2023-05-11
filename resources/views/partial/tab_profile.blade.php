<div class="flex flex-col gap-[1rem] dashboard_profile">
    <div class="header_profile flex flex-row items-center">
        <div class="w-[48px] mr-[12px]">
            <img class="image_user" src="{{ asset('storage/profile_image/Test.jpeg') }}" alt="">
        </div>
        <div class="flex flex-col">
            <span class="username_profile text-link-switch font-bold text-[#566FEF]">
                {{ \Illuminate\Support\Facades\Auth::user()->username }}
            </span>
            <a href="{{ route('account.profile') }}" class="edit_profile gap-[4px] flex flex-row items-center">
                <i class="fa-solid fa-pencil"></i>
                <span>
                    Edit profile
                </span>
            </a>
        </div>

    </div>
    <hr>
    <div class="header_profile flex flex-col gap-[0.7rem] justify-center">
        @php($routeProfile = \Illuminate\Support\Facades\URL::current())
        <a href="{{ route('account.profile') }}" class=" {{ str_contains($routeProfile, 'profile') ? 'active_choice_tab_profile' : '' }} flex flex-row items-center">
            <i class="text-[#566FEF] w-1/5 fa-solid fa-user"></i>
            <span class="text-link-switch font-bold text-[#566FEF]">
                My Account
            </span>
        </a>
        <a href="{{ route('account.cart') }}" class=" {{ str_contains($routeProfile, 'cart') ? 'active_choice_tab_profile' : '' }} flex flex-row items-center">
            <i class="text-[#566FEF] w-1/5 fa-solid fa-bag-shopping"></i>
            <span class="text-link-switch font-bold text-[#566FEF]">
                My Cart
            </span>
        </a>
        <a href="{{ route('account.order') }}" class=" {{ str_contains($routeProfile, 'order') ? 'active_choice_tab_profile' : '' }} flex flex-row items-center">
            <i class="text-[#566FEF] w-1/5 fa-solid fa-money-bill"></i>
            <span class="text-link-switch font-bold text-[#566FEF]">
                My Order
            </span>
        </a>
        <a href="{{ route('account.purchaser') }}" class=" {{ str_contains($routeProfile, 'purchaser') ? 'active_choice_tab_profile' : '' }} flex flex-row items-center">
            <i class="text-[#566FEF] w-1/5 text-[13px] fa-solid fa-cart-shopping"></i>
            <span class="text-link-switch font-bold text-[#566FEF]">
                My Purchaser
            </span>
        </a>
    </div>
</div>
