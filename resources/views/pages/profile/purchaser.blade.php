@extends('pages.profile.account_page')

@section('content_profile')
    <div class="flex flex-auto flex-col gap-[1.5rem]">
        @if(count($purchaserList) > 0)
            @foreach($purchaserList as $purchaser)
                <div class="flex flex-col justify-between gap-[1.25rem] product_cart p-[1.5rem]">
                    <div class="flex flex-row text-[1.125rem] font-bold text-[#566FEF] justify-between w-full">
                        <div class="flex flex-col gap-[0.5rem] w-1/2">
                            <div class="flex flex-row">
                                <div class="flex flex-row items-center w-[36%] gap-[0.75rem]">
                                    <i class="fa-solid w-[10%] fa-location-dot"></i>
                                    <span>Delivery Address</span>
                                </div>
                                <span>{{$purchaser->address}}</span>
                            </div>
                            <div class="flex flex-row text-[1.125rem] font-bold text-[#566FEF]">
                                <div class="flex flex-row items-center w-[36%] gap-[0.75rem]">
                                    <i class="fa-solid fa-clock w-[10%]"></i>
                                    <span>Order Time</span>
                                </div>
                                <span>{{\Carbon\Carbon::parse($purchaser->created_at)->format('Y-m-d H:m:s')}}</span>
                            </div>
                            <div class="flex flex-row text-[1.125rem] font-bold text-[#566FEF]">
                                <div class="flex flex-row items-center w-[36%] gap-[0.75rem]">
                                    <i class="fa-sharp fa-solid w-[10%] fa-circle-check"></i>
                                    <span>Process At</span>
                                </div>
                                <span>{{ $purchaser->updated_at }}</span>
                            </div>
                            <div class="flex flex-row text-[1.125rem] font-bold text-[#566FEF]">
                                <div class="flex flex-row items-center w-[36%] gap-[0.75rem]">
                                    <i class="fa-solid fa-money-bill w-[10%]"></i>
                                    <span>Price Order</span>
                                </div>
                                <span class="price_product">{{ $purchaser->price_order }}</span>
                            </div>
                        </div>
                        <div class="flex flex-row-reverse w-[45%]">
                            <span class="uppercase text-[1.5rem] font-bold
                            {{$purchaser->status_order == 2 ? 'text-[green]' : 'text-[red]'}}
                            ">
                                {{ $purchaser->statusOrder->status_order }}
                            </span>
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
                    @php($check = \Carbon\Carbon::parse($purchaser->updated_at)->diffInDays(\Carbon\Carbon::now()) < 7)
                    @foreach($purchaser->order_info as $order_info)
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
                        @if(!$order_info->status && $check && ($purchaser->status_order != 3))
                            <div id="{{$order_info->id_product}}">
                                <div class="flex flex-row justify-between w-full items-center">
                                    <div class="w-[40%]">
                                        <span>
                                            Comment
                                        </span>
                                    </div>
                                    <div class="flex flex-row items-center justify-center w-1/5">
                                        <span>
                                            Rating Star
                                        </span>
                                    </div>
                                    <div class="flex flex-row items-center w-[17%] justify-center">
                                        &nbsp;
                                    </div>
                                    <div class="flex flex-row items-center w-[13%] justify-center">
                                        &nbsp;
                                    </div>
                                </div>
                                <div class="flex flex-row justify-between w-full items-center">
                                    <div class="flex-row flex w-[40%] h-[100%]">
                                        <textarea class="w-full comment_rating" id="comment{{$order_info->id_product}}"></textarea>
                                    </div>
                                    <div class="flex flex-col items-center justify-center w-1/5">
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
                                    <div class="flex flex-row items-center w-[17%] justify-center">
                                        <button class="button-action rounded font-bold w-full"
                                                onclick="uploadRating({{ $order_info->id_product }}, {{ $purchaser->id }})">
                                            <span class="uppercase">
                                                Rating
                                            </span>
                                        </button>
                                    </div>
                                    <div class="flex flex-row items-center w-[13%] justify-center">
                                        &nbsp;
                                    </div>
                                </div>
                            </div>

                        @endif
                        <hr>
                    @endforeach
                </div>
            @endforeach
        @else
            <img src="{{asset("storage/product_image/no-product-found-image.png")}}" alt="">
        @endif

    </div>
@endsection

@section('script_account')
    <script type="text/javascript">
        function routeAddComment() {
            return '{{ route('account.add_comment') }}'
        }
    </script>
    <script src="{{ asset('assets/js/purchaser.js') }}"></script>
@endsection
