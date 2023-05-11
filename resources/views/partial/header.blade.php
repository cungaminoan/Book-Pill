<header class="header-main flex flex-col justify-between">
    <div class="flex flex-row items-center justify-between">
        <div class="flex flex-row items-center gap-[0.5rem]">
            <span id="text_header_download" class="cursor-pointer">
                Download
            </span>
            <div class="modal_download top-[30px] absolute w-[64px] h-[10px]">
            </div>
            <div id="modal_download" class="modal_download">
                <div class="flex flex-col">
                    <img src="{{ asset('storage/qr/frame.png') }}" alt="">
                    <div class="flex flex-row items-center pl-[16px] pb-[16px] pr-[16px] justify-between">
                        <img src="{{ asset('storage/brand_tech/appstore.png') }}" alt="">
                        <img src="{{ asset('storage/brand_tech/google_play.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="hr-vertical"></div>
            <span class="text_header">
                Follow on us
            </span>
            <a href="">
                <i class="fa-brands fa-facebook text-gray-50"></i>
            </a>
            <a href="">
                <i class="fa-brands fa-instagram text-gray-50"></i>
            </a>
        </div>
        <div class="flex flex-row items-center gap-[0.5rem]">
            @if(!\Illuminate\Support\Facades\Auth::check())
            <a href="{{ route('sign_in') }}" class="text-link-switch text-gray-50">
                <span>
                    Sign In
                </span>
            </a>
            <div class="hr-vertical"></div>
            <a href="{{ route('register') }}" class="text-link-switch text-gray-50">
                <span>
                    Register
                </span>
            </a>
            @else
            <div class="flex flex-col justify-between items-center gap-[0.5rem]" id="profile">
                <a class="text-link-switch text-gray-50" id="profile_name" href="{{ route('account.profile') }}">
                    <span>
                        {{ \Illuminate\Support\Facades\Auth::user()->username }}
                    </span>
                </a>
            </div>
            <div class="flex flex-row items-center justify-center absolute" style="width: 116px; right: 40px; top: 30px">
                <div class="profile_expand profile"></div>
            </div>
            <div class="profile_menu profile">
                <div class="flex flex-col">
                    <a href="{{ route('account.profile') }}">
                        <span>
                            My Account
                        </span>
                    </a>
                    <a href="{{ route('logout') }}">
                        <span>
                            Logout
                        </span>
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="flex flex-row items-center justify-between">
        <a href="{{ route('main') }}" class="w-[17%]">
            <img class="image_header" src="{{ asset('storage/source_image/main_logo.png') }}" alt="">
        </a>
        <div class="flex flex-row w-4/5">
            <form action="{{ route('product.search') }}" class="w-4/5 flex flex-row-reverse items-center" id="search_area">
                <input type="text" class="search_header" name="key" id="search_product">
                <button id="button_search" class="button-action">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>

                <div class="search_dropdown">
                    <div class="flex flex-col search_result">
                    </div>
                </div>

            </form>
            <div class="w-1/5 flex flex-col justify-end items-center">
                @if(\Illuminate\Support\Facades\Auth::check())
                    <a href="{{ route('account.cart') }}">
                        <i class="fa-sharp fa-solid fa-cart-shopping" id="cart_user"></i>
                    </a>
                    <div class="flex flex-row-reverse absolute" style="width: 400px ; right: calc(8%); bottom: 9px">
                        <div class="cart cart_expand"></div>
                    </div>
                    <div id="cart_detail" class="cart">
                    </div>
                @endif

            </div>
        </div>
    </div>

</header>

<script>
    function routeSearchTitleProduct() {
        return '{{ route('product.title') }}'
    }

    function routeCartList() {
        return '{{ route('account.cart') }}'
    }
</script>
