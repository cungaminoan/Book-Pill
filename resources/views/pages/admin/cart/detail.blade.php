@extends('layout.admin.master')

@section('content')
    <div class="flex flex-col">
        <div class="flex flex-row w-full">
            <div class="flex flex-col w-3/4">
                <div class="flex label_content_product flex-row items-center">
                    <span class="w-1/5 font-bold">
                        User Order
                    </span>
                    <span class="content_product">{{ $foundOrder->user->username }}</span>
                </div>
                <div class="flex flex-row label_content_product items-center">
                    <span class="w-1/5 font-bold">
                        Price Order
                    </span>
                    <span class="price_product">{{ $foundOrder->price_order }}</span>
                </div>
                <div class="flex flex-row label_content_product items-center">
                    <span class="w-1/5 font-bold">
                        Address Delivery
                    </span>
                    <span class="content_product">{{ $foundOrder->address }}</span>
                </div>
                <div class="flex flex-row label_content_product items-center">
                    <span class="w-1/5 font-bold">
                        Time Order
                    </span>
                    <span class="content_product">{{ $foundOrder->created_at }}</span>
                </div>
                <div class="flex flex-row label_content_product items-center">
                    <span class="w-1/5 font-bold">Status User</span>
                    <span class="content_product font-bold uppercase {{ $foundOrder->user->status == 1 ? 'text-[green]' : 'text-[red]'}}">
                        {{ $foundOrder->user->statusUser->status_user }}
                    </span>
                </div>
                <div class="flex flex-row label_content_product items-center">
                    <span class="w-1/5 font-bold">Status Order</span>
                    <span id="status_order"
                          class="content_product font-bold uppercase @if($foundOrder->status_order != 1) {{$foundOrder->status_order == 2 ? 'text-[green]' : 'text-[red]'}} @endif">
                        {{ $foundOrder->statusOrder->status_order }}
                    </span>
                </div>
            </div>
            <div class="flex flex-row-reverse w-1/4 items-center">
                <div class="flex flex-col w-3/4 gap-[1.25rem] items-center">
                    @if($foundOrder->status_order == 1)
                        <button onclick="progressOrder('accept', {{ $foundOrder->id }})" class="btn-handle btn w-full btn-edit rounded font-bold text-center">
                            <span>
                                Accept
                            </span>
                        </button>
                        <button onclick="progressOrder('deny', {{ $foundOrder->id }})" class="btn-handle btn btn-danger w-full rounded font-bold text-center">
                            <span>
                                Deny
                            </span>
                        </button>
                    @endif
                    <a role="button" href="{{ route('admin.order.list') }}" class="btn btn-back w-full rounded font-bold text-center">
                        <span>
                            Back
                        </span>
                    </a>
                </div>
            </div>
        </div>

        <div class="flex flex-col justify-between mt-[1.25rem] mb-[1.25rem] gap-[1.25rem] product_cart p-[1.5rem]">
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
            @foreach($foundOrder->order_info as $order_info)
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
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function routeHandleOrder() {
            return '{{ route('admin.order.handle') }}'
        }
    </script>
    <script src="{{ asset('assets/js/admin/orderAdmin.js') }}"></script>
@endsection
