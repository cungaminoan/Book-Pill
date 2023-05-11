@extends('layout.master')

@section('content')
    <div class="flex flex-col gap-[2rem]">
        <div class="flex flex-row detail_product_bg">
            <div class="w-2/5 p-[15px] flex flex-col justify-between items-center">
                <div class="w-full mb-[8px]">
                    <img class="border w-full" id="main_image_detail" src="{{ asset('storage/product_image/' . $product->id . '/' . $imageProduct->get(0)) }}" alt="">
                </div>
                <div class="flex flex-row gap-[8px]">
                    @foreach($imageProduct as $image)
                        <img onclick="changeMainImage(this.src)" class="border image_expand w-1/5" src="{{ asset('storage/product_image/' . $product->id . '/' . $image) }}" alt="">
                    @endforeach
                </div>
            </div>
            <div class="w-3/5 flex flex-col product_detail">
            <span class="title_product_detail">
                {{ $product->title }}
            </span>
                <div class="flex flex-row items-center rating_product gap-[2rem]">
                    <div class="flex flex-row items-center gap-[4px]">
                    <span class="text-[#566FEF] underline">
                        {{ $product->rating }}
                    </span>
                        <div class="flex flex-row gap-[2px]">
                            @foreach(range(1,5) as $j)
                                @if($j <= $product->rating)
                                    <span class="fa-stack" style="width:1em">
                                        <i class="text-[#566FEF] fas fa-star fa-stack-1x"></i>
                                    </span>
                                @else
                                    <span class="fa-stack" style="width:1em">
                                        <i class="text-[#566FEF] far fa-star fa-stack-1x"></i>
                                    </span>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="w-[1px] h-[28px] hr-vertical">
                    </div>
                    <div class="flex flex-row items-center gap-[4px]">
                    <span class="underline">
                        {{ count($product->commentProduct) }}
                    </span>
                        <span class="label_content_profile">
                        Ratings
                    </span>
                    </div>
                    <div class="w-[1px] h-[28px] hr-vertical">
                    </div><div class="flex flex-row items-center gap-[4px]">
                    <span>
                        {{ $product->sold }}
                    </span>
                        <span class="label_content_profile">
                        Sold
                    </span>
                    </div>
                </div>
                <div class="flex flex-row items-center price">
                    @if($product->discount == 0.0)
                        <span class="text-[1.875rem] font-semibold price_product">{{ $product->price }}</span>
                    @else
                        <span class="text-[1rem] price_old">{{ $product->price }}</span>
                        <span class="text-[1.875rem] font-semibold price_product">{{ $product->price - ($product->price * ($product->discount) / 100) }}</span>
                    @endif
                </div>
                <div class="flex flex-row option_get_product">
                    <div class="w-1/5 flex flex-row">
                    <span class="label_content_profile">
                        Shipping
                    </span>
                    </div>
                    <div class="w-4/5 flex flex-col gap-[0.3rem]">
                        <div class="flex flex-row items-center gap-[2rem]">
                            <div class="w-1/4 flex flex-row items-center gap-[8px]">
                                <i class="text-[#566FEF] fa-solid fa-truck"></i>
                                <span class="label_content_profile">
                                Shipping From
                            </span>
                            </div>
                            <div class="w-1/2 flex flex-row">
                            <span class="font-semibold">
                                {{ $product->deliveryFrom->delivery_from }}
                            </span>
                            </div>
                        </div>
                        <div class="flex flex-row items-center gap-[2rem]">
                            <div class="w-1/4 flex gap-[8px] flex-row">
                                <i class="text-[#566FEF] fa-solid fa-truck" style="visibility: hidden"></i>
                                <span class="label_content_profile">
                                Shipping Fee
                            </span>
                            </div>
                            <span class="text-[#566FEF]">
                                ₫30000
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col gap-[0.5rem] product_information">
                    <div class="flex flex-row ">
                    <span class="text_product_information w-[18%]">
                        Author
                    </span>
                        <a href="{{ route('product.author', ['author' => $product->authorProduct->id]) }}" class="text_product_information text-[#566FEF]">
                            {{ $product->authorProduct->author_name}}
                        </a>
                    </div>
                    <div class="flex flex-row">
                    <span class="text_product_information w-[18%]">
                        Genre
                    </span>
                        <div class="flex flex-row gap-[16px] items-center">
                            @foreach($genreList as $genre)
                                <a href="{{ route('product.genre', ['genre' => $genre->id]) }}" class="text_product_information text-[#566FEF]">
                                    {{ $genre->genre_name }}
                                </a>
                            @endforeach
                        </div>

                    </div>
                    <div class="flex flex-row">
                    <span class="text_product_information w-[18%]">
                        Age Range
                    </span>
                        <a href="" class="text_product_information text-[#566FEF]">
                            {{ $product->ageRange->age_range }}
                        </a>
                    </div>

                </div>
                <div class="flex flex-row button_action_product gap-[1rem]">
                    <button value="{{ $product->id }}"
                            class="flex flex-row items-center add_to_cart gap-[4px]"
                    >
                        <i class="fa-solid fa-cart-plus"></i>
                        <span>Add To Cart</span>
                    </button>
{{--                    <button class="flex flex-row items-center buy_product_now">--}}
{{--                        <span>Buy Now</span>--}}
{{--                    </button>--}}
                </div>
            </div>
        </div>
        <div class="flex flex-row justify-between w-full">
            <div class="flex flex-col comment_product gap-[0.5rem] w-[80%]">
                <div class="flex flex-row items-center justify-between">
                    <span class="title_comment_product">
                        Product Ratings
                    </span>
                    @if(count($product->commentProduct) > 3)
                        <div class="flex flex-row items-center">
                            @foreach(range(5,1) as $i)
                                <div onclick="chooseRating(this)" value="{{$i}}" class="flex flex-row justify-between pr-[12px] pl-[12px] rating items-center gap-[6px]">
                                    @foreach(range(1,5) as $j)
                                        <span class="fa-stack" style="width:1em">
                                            <i class="far fa-star fa-stack-1x"></i>
                                            @if($i >= $j)
                                                <i class="fas fa-star fa-stack-1x"></i>
                                            @else
                                                <i class="far fa-star fa-stack-1x"></i>
                                            @endif
                                    </span>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <hr>
                <div class="flex flex-col rating_product_comment">
                    @include('partial.comment', ['commentList' => $product->commentProduct])
                </div>
            </div>
            <div class="flex flex-col gap-[3px] related_product w-[18%]">
                @foreach($relatedProduct as $relate)
                    <a href="{{ route('product.detail', ['id' => $relate->id]) }}" class="flex flex-col related_product_card gap-[8px]">
                        <img src="{{ asset('storage/product_image/' . $relate->id . '/img1.jpg') }}" alt="">
                        <span>
                            {{ $relate->title }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">

        function routeAddProductToCart() {
            return '{{ route('account.cart') }}'
        }

        function routeGetComment() {
            return '{{ route('product.get_comment') }}'
        }

        function productID() {
            return '{{$product->id}}'
        }

        function checkLogin() {
            return '{{ \Illuminate\Support\Facades\Auth::check() }}'
        }
    </script>
    <script src="{{ asset('assets/js/detail.js') }}"></script>
@endsection
