<header class="flex flex-row items-center justify-between header_admin">
    <a class="w-[11%]" href="{{ route('admin.product.list') }}">
        <img class="image_header" src="{{ asset('storage/source_image/main_logo.png') }}" alt="">
    </a>
    <a href="">
        <span class="text-[#566FEF]">
            {{ \Illuminate\Support\Facades\Auth::user()->username }}
        </span>
    </a>
</header>
