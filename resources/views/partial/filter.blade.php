<div class="flex flex-col filter gap-[1rem]">
    <div class="flex flex-row items-center">
        <i class="fa-solid fa-filter mr-[12px]"></i>
        <span class="text_filter">Search Filter</span>
    </div>
    <div class="flex flex-col gap-[0.5rem]">
        <span class="label_filter">
            By genre
        </span>
        <div class="flex flex-col genre_filter gap-[0.5rem]">
            @foreach($genreList as $genre)
                <div class="flex flex-row items-center">
                    <input type="checkbox" name="genre[]" value="{{ $genre->id }}" class="check_box_filter">
                    <span>{{ $genre->genre_name }}</span>
                </div>
            @endforeach
        </div>


    </div>
    <hr>
    <div class="flex flex-col gap-[0.5rem]">
        <span class="label_filter">
            Shipped from
        </span>
        <div class="flex flex-row items-center">
            <input type="checkbox" onclick="checkDeliveryValue(this)" name="delivery" value="1" class="check_box_filter">
            <span>
                TP. Ha Noi
            </span>
        </div>
        <div class="flex flex-row items-center">
            <input type="checkbox" onclick="checkDeliveryValue(this)" name="delivery" value="2" class="check_box_filter">
            <span>
                TP. Ho Chi Minh
            </span>
        </div>
    </div>
    <hr>
    <div class="flex flex-col gap-[0.5rem]">
        <span class="label_filter">
            Price Range
        </span>
        <div class="flex flex-row items-center justify-between mb-[1rem]">
            <input type="text" class="input_price_filter" name="min_price" placeholder="₫ MIN">
            <div class="hr_vertical_price"></div>
            <input type="text" class="input_price_filter" name="max_price" placeholder="₫ MAX">
        </div>
        <button class="button-action" onclick="getFilterProduct()">
            <span>
                APPLY
            </span>
        </button>
    </div>
    <hr>
    <div class="flex flex-col gap-[0.5rem]">
        <span class="label_filter">
            Rating
        </span>
        <div class="flex flex-col items-center">
            <div class="flex flex-col">
                @foreach(range(5,1) as $i)
                    <div onclick="chooseRating(this)" class="flex flex-row pr-[12px] pl-[12px] {{ $i == 5 ? 'rating_not_have_text' : '' }} rating items-center gap-[6px]">
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
                        @if($i <= 4)
                            <span class="text-[14px]">
                                & Up
                            </span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <hr>
    <button onclick="clearFilter()" class="button-action mb-[0.5rem]">
        <span>
            CLEAR ALL
        </span>
    </button>
</div>
