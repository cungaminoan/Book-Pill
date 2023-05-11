    <div class="flex flex-col justify-between gap-[0.75rem] product_cart p-[1.5rem]">
        <div class="flex flex-row items-center text-[1.125rem] gap-[0.75rem]">
            <i class="fa-solid fa-location-dot text-[#566FEF]"></i>
            <span class="text-[#566FEF] font-bold">
                    Delivery Address
                </span>
        </div>
        <div class="flex flex-row items-center text-[#566FEF] font-bold text-[1.125rem] gap-[0.75rem]">
            <div class="flex flex-row items-center text-[#566FEF] font-bold text-[1.125rem] gap-[0.75rem]">
                    <span>
                        {{ \Illuminate\Support\Facades\Auth::user()->full_name }}
                    </span>
                <span>
                        {{ \Illuminate\Support\Facades\Auth::user()->phone_number }}
                    </span>
            </div>
            <div class="flex flex-col flex-auto">
                <input type="text" placeholder="Address" value="" class="w-full input_auth_username m-0" id="address" required>
            </div>
        </div>

    </div>
    <div class="flex flex-row justify-between items-center product_cart">
        <div class="flex flex-row items-center justify-center w-[5%]">
        </div>
        <div class="flex flex-row w-[40%]">
                <span>
                    Product Ordered
                </span>
        </div>
        <div class="flex flex-row items-center justify-center w-1/5">
                <span>
                    Unit Price
                </span>
        </div>
        <div class="flex flex-row items-center w-[17%] justify-center">
                <span>
                    Amount
                </span>
        </div>
        <div class="flex flex-row items-center w-[13%] justify-center">
                <span>
                    Item Subtotal
                </span>
        </div>

    </div>
    @foreach($productList as $product)
        <div class="flex flex-row justify-between items-center product_cart product_order" id="{{ $product->id }}">
            <div class="flex flex-row items-center justify-center w-[5%]">
            </div>
            <div class="flex flex-row w-[40%] items-center justify-between">
                <img width="25%" class="image_border" style="aspect-ratio: 3/4" src="{{ asset('storage/product_image/' . $product->id . '/img1.jpg') }}" alt="">
                <div class="w-[72%]">
                    <span>
                        {{ $product->title }}
                    </span>
                </div>
            </div>
            <div class="flex flex-row items-center w-1/5 justify-center">
                <span class="price_product text-[1rem] " id="unitPrice{{$product->id}}" >{{ $product->unitPrice }}</span>
            </div>
            <div class="flex flex-row items-center w-[17%] justify-center">
                <span id="quantity{{$product->id}}">{{ $product->quantity }}</span>
            </div>
            <div class="flex flex-row items-center w-[13%] justify-center">
                <span class="price_product text-[1rem]" id="subTotal{{$product->id}}">{{ $product->subTotal }}</span>
            </div>
        </div>
    @endforeach
    <div class="flex flex-row-reverse items-center product_cart p-[1.5rem]">
        <div class="flex flex-col w-[32%] gap-[0.75rem]" id="order_total">
            <div class="flex h-[48px] flex-row items-center justify-between">
                <span class="w-[49%]">
                    Merchandise Subtotal
                </span>
                <span class="price_product flex flex-row-reverse text-[1rem] w-[50%]" id="totalSub">{{ $totalSub }}</span>
            </div>
            <div class="flex h-[48px] flex-row items-center justify-between">
                <span class="w-[49%]">
                    Shipping Price
                </span>
                <span class="price_product flex flex-row-reverse text-[1rem] w-[50%]" id="shippingPrice">{{ $shippingPrice }}</span>
            </div>
            <div class="flex flex-row items-center justify-between">
                <span class="w-[49%]">
                    Total Payment
                </span>
                <span class="flex flex-row-reverse text-[#566FEF] text-[2rem] w-[50%]" id="totalOrder">{{ $totalOrder }}</span>
            </div>
            <button class="button-action rounded font-bold" id="order">
                <span>
                    Place Order
                </span>
            </button>
        </div>
    </div>

    <script type="text/javascript">
        function routeCart() {
            return '{{ route('account.cart') }}'
        }

        function routeCreateOrder() {
            return '{{ route('account.create_order') }}'
        }

        function routeOrder() {
            return '{{ route('account.order') }}'
        }
    </script>

    <script src="{{ asset('assets/js/order.js') }}"></script>

