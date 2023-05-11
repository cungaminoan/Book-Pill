<a href="{{ route('product.detail', ['id' => $product->id]) }}" class="flex flex-col justify-between product transition ease-in-out hover:-translate-y-1 hover:scale-110 duration-300">
    <img src="{{ asset('storage/product_image/' . $product->id . '/img1.jpg') }}" alt="">
    <div class="flex flex-col gap-[0.5rem] p-[0.5rem]">
        <span class="title_product text-[0.85rem]">
            {{ $product->title }}
        </span>
        <div class="flex flex-row items-center">
            @if($product->discount == 0.00)
                <span class="price_product">{{ $product->price }}</span>
            @else
                <span class="price_old">{{ $product->price }}</span>
                <span class="price_product">{{ $product->price - ($product->price * ($product->discount / 100)) }}</span>
            @endif
        </div>
        <div class="flex flex-row items-center gap-[12px]">
            <div class="flex flex-row">
                    @foreach(range(1,5) as $j)
                        @if($j <= $product->rating)
                            <span class="fa-stack" style="width:0.7em">
                                <i class="fas text-[10px] fa-star fa-stack-1x"></i>
                            </span>
                        @else
                            <span class="fa-stack" style="width:0.7em">
                                <i class="far text-[10px] fa-star fa-stack-1x"></i>
                            </span>
                        @endif
                    @endforeach
            </div>
            <div class="flex flex-row text-[0.85rem] gap-[2px]">
                <span>{{ $product->sold }}</span>
                <span>sold</span>
            </div>
        </div>
        <span class="text-[0.85rem]">
            {{ $product->deliveryFrom->delivery_from }}
        </span>
    </div>
</a>
