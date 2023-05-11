@extends('pages.profile.account_page')

@section('content_profile')
    <div class="flex flex-auto flex-col gap-[1.5rem]">
        @if(count($foundOrder) > 0)
            @foreach($foundOrder as $order)
                <div class="flex flex-col justify-between gap-[1.25rem] product_cart p-[1.5rem]">
                    <div class="flex flex-row text-[1.125rem] font-bold text-[#566FEF] justify-between w-full">
                        <div class="flex flex-col gap-[0.5rem] w-1/2">
                            <div class="flex flex-row">
                                <div class="flex flex-row items-center w-[36%] gap-[0.75rem]">
                                    <i class="fa-solid w-[10%] fa-location-dot"></i>
                                    <span>Delivery Address</span>
                                </div>
                                <span>{{$order->address}}</span>
                            </div>
                            <div class="flex flex-row text-[1.125rem] font-bold text-[#566FEF]">
                                <div class="flex flex-row items-center w-[36%] gap-[0.75rem]">
                                    <i class="fa-solid fa-clock w-[10%]"></i>
                                    <span>Order Time</span>
                                </div>
                                <span>{{\Carbon\Carbon::parse($order->created_at)->format('Y-m-d H:m:s')}}</span>
                            </div>
                            <div class="flex flex-row text-[1.125rem] font-bold text-[#566FEF]">
                                <div class="flex flex-row items-center w-[36%] gap-[0.75rem]">
                                    <i class="fa-solid fa-money-bill w-[10%]"></i>
                                    <span>Price Order</span>
                                </div>
                                <span class="price_product">{{ $order->price_order }}</span>
                            </div>
                        </div>
                        <div class="flex flex-row-reverse w-[45%]">
                            <div class="loading">
                                @php($statusCharacters = str_split($order->statusOrder->status_order))
                                @foreach($statusCharacters as $character)
                                    <div class="loading__letter">{{ $character }}</div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="flex flex-row justify-between items-center">
                        <div class="flex flex-row w-[40%]">
                            <span>Product Ordered</span>
                        </div>
                        <div class="flex flex-row items-center justify-center w-1/5">
                            <span>Unit Price</span>
                        </div>
                        <div class="flex flex-row items-center w-[17%] justify-center">
                            <span>Amount</span>
                        </div>
                        <div class="flex flex-row items-center w-[13%] justify-center">
                            <span>Item Subtotal</span>
                        </div>

                    </div>
                    <hr>
                    @foreach($order->order_info as $order_info)
                        <div class="flex flex-row justify-between items-center">
                            <div class="flex flex-row w-[40%] items-center justify-between">
                                <img width="25%" class="image_border" style="aspect-ratio: 3/4" src="{{ asset('storage/product_image/' . $order_info->id_product . '/img1.jpg') }}" alt="">
                                <div class="w-[72%]">
                                    <span>{{ $order_info->title }}</span>
                                </div>
                            </div>
                            <div class="flex flex-row items-center justify-center w-1/5">
                                <span class="price_product text-[1rem] ">{{ $order_info->unit_price }}</span>
                            </div>
                            <div class="flex flex-row items-center w-[17%] justify-center">
                                <span>{{ $order_info->quantity }}</span>
                            </div>
                            <div class="flex flex-row items-center w-[13%] justify-center">
                                <span class="price_product text-[1rem]">{{ $order_info->subTotal }}</span>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            @endforeach
        @else
            <img src="{{asset("storage/product_image/no-product-found-image.png")}}" alt="">
        @endif

    </div>
@endsection
