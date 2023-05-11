@extends('layout.master')

@section('content')
    <div class="flex flex-row {{ !isset($genreList) ? ' items-center justify-center ' : '' }}">
        {{--        Filter          --}}
        @if(isset($genreList))
            @include('partial.filter', ['genreList' => $genreList])
        @endif
        {{--        End filter          --}}
        {{--        Main product list       --}}
        <div class="flex product_area flex-col">
            @if(isset($search))
                <div class="flex flex-row items-center">
                    <i class="fa-regular fa-lightbulb mr-[12px]"></i>
                    <span>
                        Search result for '
                    </span>
                    <span class="text-[#566FEF]">
                        {{ $search }}
                    </span>
                    <span>
                        '
                    </span>
                </div>
            @endif

            <div id="product_result">
                <div class="flex flex-col mb-[2rem]">
                    <div class="loading text-[#566FEF] font-bold">
                        <div class="loading__letter">T</div>
                        <div class="loading__letter">O</div>
                        <div class="loading__letter mr-[8px]">P</div>
                        <div class="loading__letter">S</div>
                        <div class="loading__letter">E</div>
                        <div class="loading__letter">L</div>
                        <div class="loading__letter">L</div>
                        <div class="loading__letter">E</div>
                        <div class="loading__letter">R</div>
                    </div>
                    <div class="product_list_search grid grid-cols-5 mt-[2rem] gap-[8px]">
                        @foreach($topSeller as $top)
                            @include('partial.product_card', ['product' => $top])
                        @endforeach
                    </div>
                </div>
                <hr>
                @if(isset($recommendProductList))
                    <div class="flex flex-col mt-[2rem] mb-[2rem]">
                        <div class="loading text-[#566FEF] font-bold">
                            <div class="loading__letter">R</div>
                            <div class="loading__letter">E</div>
                            <div class="loading__letter">C</div>
                            <div class="loading__letter">O</div>
                            <div class="loading__letter">M</div>
                            <div class="loading__letter">M</div>
                            <div class="loading__letter">E</div>
                            <div class="loading__letter">N</div>
                            <div class="loading__letter mr-[8px]">D</div>
                            <div class="loading__letter">F</div>
                            <div class="loading__letter">O</div>
                            <div class="loading__letter mr-[8px]">R</div>
                            <div class="loading__letter">Y</div>
                            <div class="loading__letter">O</div>
                            <div class="loading__letter">U</div>
                        </div>
                        <div class="product_list_search grid grid-cols-5 mt-[2rem] gap-[8px]">
                            @foreach($recommendProductList as $recommend)
                                @include('partial.product_card', ['product' => $recommend])
                            @endforeach
                        </div>
                    </div>
                    <hr>
                @endif
                @if(count($productList) > 0)
                    <div class="product_list_search grid grid-cols-5 mt-[2rem] gap-[8px]">
                        @foreach($productList as $product)
                            @include('partial.product_card', ['product' => $product])
                        @endforeach
                    </div>
                @else
                    <img src="{{ asset('storage/product_image/no-product-found-image.png') }}" alt="">
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function routeFilterProduct() {
            return '{{ route('product.filter') }}'
        }
    </script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endsection
