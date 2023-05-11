@if(count($commentList) > 0)
    @foreach($commentList as $commentProduct)
        <div class="flex flex-col gap-[0.5rem]">
            <div class="flex flex-row items-center justify-between">
                <div class="flex flex-row items-center gap-[0.5rem]">
                    <img width="3.5%" src="{{ asset('storage/profile_image/Test.jpeg') }}" alt="" class="image_user">
                    <span class="text-[#566FEF]">
                        {{ $commentProduct->user->username }}
                    </span>
                    <div class="flex flex-row gap-[2px]">
                        @foreach(range(1,5) as $j)
                            @if($j <= $commentProduct->rating)
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
                <span class="w-[18%] text-right">
                    {{ $commentProduct->created_at }}
                </span>
            </div>
            <div class="flex-row flex gap-[0.5rem]">
                <div class="w-[3%]">
                </div>
                <span>
                    {{ $commentProduct->comment }}
                </span>
            </div>
            <hr>
        </div>
    @endforeach
@else
    <div class="flex flex-col items-center justify-center h-full">
        <span>
            No Any Product Rating
        </span>
    </div>
@endif
