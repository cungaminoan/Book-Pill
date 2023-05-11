@extends('layout.admin.master')

@section('content')
    <div class="flex flex-col">
        <div class="flex label_content_product flex-row items-center">
            <span class="w-1/5 font-bold">
                Title
            </span>
            <span class="content_product">
                {{ $foundProduct->title }}
            </span>
        </div>
        <div class="flex flex-row label_content_product items-center">
            <span class="w-1/5 font-bold">
                Author
            </span>
            <span class="content_product">
                {{ $foundProduct->authorProduct->author_name }}
            </span>
        </div>
        <div class="flex flex-row label_content_product items-center">
            <span class="w-1/5 font-bold">
                Delivery From
            </span>
            <span class="content_product">
                {{ $foundProduct->deliveryFrom->delivery_from }}
            </span>
        </div>
        <div class="flex flex-row label_content_product items-center">
            <span class="w-1/5 font-bold">
                Age Range
            </span>
            <span class="content_product">
                {{ $foundProduct->ageRange->age_range }}
            </span>
        </div>
        <div class="flex flex-row label_content_product items-center">
            <span class="w-1/5 font-bold">
                Price
            </span>
            <span class="content_product">
                {{ '₫' . $foundProduct->price }}
            </span>
        </div>
        <div class="flex flex-row label_content_product items-center">
            <span class="w-1/5 font-bold">
                Discount
            </span>
            <span class="content_product">
                {{ $foundProduct->discount . '%' }}
            </span>
        </div>
        <div class="flex flex-row label_content_product items-center">
            <span class="w-1/5 font-bold">
                Number of Product
            </span>
            <span class="content_product">
                {{ $foundProduct->number_of_product }}
            </span>
        </div>
        <div class="flex flex-row label_content_product items-center">
            <span class="w-1/5 font-bold">
                Status
            </span>
            <span class="content_product uppercase">
                {{ $foundProduct->statusProduct->status_product }}
            </span>
        </div>
        <div class="flex flex-row label_content_product ">
            <span class="w-1/5 font-bold">
                Genre
            </span>
            <div class="grid grid-cols-5 gap-[0.5rem] w-4/5">
                @foreach($genreList as $genre)
                    @php($check = $genreProduct->contains(function ($genreValue, $key) use ($genre){
                        return $genreValue == $genre->id;
                    }))
                    <div class="flex flex-row items-center">
                        <input type="checkbox" {{$check ? 'checked' : ''}} disabled>
                        <span class="content_product ml-[8px]">
                            {{ $genre->genre_name }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex flex-row label_content_product" style="border-bottom: none">
            <span class="w-1/5 font-bold">
                Image
            </span>
            <div class="flex w-4/5 gap-[0.5rem] flex-col">
                @foreach($imageList as $image)
                    @if($loop->first)
                        <div class="flex flex-row justify-between">
                            <img class="image_border w-1/2" src="{{ asset('storage/product_image/' . $foundProduct->id . '/' . $image) }}" alt="">
                            <span class="w-[49%] text-[red]">
                                *This image will be shown as the main image of product
                            </span>
                        </div>
                    @else
                        <div class="flex flex-row">
                            <img class="image_border w-1/2" src="{{ asset('storage/product_image/' . $foundProduct->id . '/' . $image) }}" alt="">
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="flex flex-col items-center justify-center mt-[1rem] mb-[1rem]">
            <a role="button" href="{{ route('admin.product.list') }}" class="button-action w-1/4 rounded font-bold text-center">
                <span>
                    OK
                </span>
            </a>
        </div>
    </div>
@endsection
