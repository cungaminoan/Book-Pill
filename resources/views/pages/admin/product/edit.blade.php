@extends('layout.admin.master')

@section('content')
    <form action="{{ route('admin.product.post_edit') }}" method="POST" class="flex flex-col p-[1.5rem]">
        @csrf
        <input type="text" hidden name="product_id" value="{{ $foundProduct->id }}">
        <div class="flex label_content_product flex-row items-center">
            <span class="w-1/5 font-bold">
                Title
            </span>
            <input type="text" class="w-4/5 input_auth_username m-0" name="title_product" placeholder="Title Product" value="{{ $foundProduct->title }}" required>
        </div>
        <div class="flex flex-row label_content_product items-center">
            <span class="w-1/5 font-bold">
                Author
            </span>
            <input type="text" class="w-4/5 input_auth_username m-0" name="author_product" placeholder="Author Product"
                   value="{{ $foundProduct->authorProduct->author_name }}"
                   required
            >
            <input type="text" value="{{$foundProduct->author}}" name="author_id" hidden>
        </div>
        <div class="flex flex-row label_content_product items-center">
            <span class="w-1/5 font-bold">
                Delivery From
            </span>
            <div class="flex flex-row items-center gap-[12px]">
                <div class="flex flex-row items-center gap-[4px]">
                    <input type="radio" {{ $foundProduct->delivery == 1 ? 'checked' : ''}} value="1" name="delivery">
                    <label for="delivery" class="content_product">TP. Ha Noi</label>
                </div>
                <div class="flex flex-row items-center gap-[4px]">
                    <input type="radio" {{ $foundProduct->delivery == 2 ? 'checked' : ''}} value="2" name="delivery">
                    <label for="delivery" class="content_product">TP. Ho Chi Minh</label>
                </div>
            </div>
        </div>
        <div class="flex flex-row label_content_product items-center">
            <span class="w-1/5 font-bold">
                Age Range
            </span>
            <div class="flex flex-row items-center gap-[12px]">
                <div class="flex flex-row items-center gap-[4px]">
                    <input type="radio" {{ $foundProduct->ageRange->id == 1 ? 'checked' : ''}} value="1" name="age_range">
                    <label for="age_range" class="content_product">All Age</label>
                </div>
                <div class="flex flex-row items-center gap-[4px]">
                    <input type="radio" {{ $foundProduct->ageRange->id == 2 ? 'checked' : ''}} value="2" name="age_range">
                    <label for="delivery" class="content_product">12+</label>
                </div>
                <div class="flex flex-row items-center gap-[4px]">
                    <input type="radio" {{ $foundProduct->ageRange->id == 3 ? 'checked' : ''}} value="3" name="age_range">
                    <label for="age_range" class="content_product">16+</label>
                </div>
                <div class="flex flex-row items-center gap-[4px]">
                    <input type="radio" {{ $foundProduct->ageRange->id == 4 ? 'checked' : ''}} value="4" name="age_range">
                    <label for="delivery" class="content_product">18+</label>
                </div>
            </div>
        </div>
        <div class="flex flex-row label_content_product items-center">
            <span class="w-1/5 font-bold">
                Price
            </span>
            <input type="number" class="w-2/5 input_auth_username m-0" name="price" placeholder="Price Product"
                   value="{{ $foundProduct->price }}"
                   required
            >

        </div>
        <div class="flex flex-row label_content_product items-center">
            <span class="w-1/5 font-bold">
                Discount
            </span>
            <input type="number" step="0.01" max="30" min="0" class="w-2/5 input_auth_username m-0" name="discount"
                   placeholder="Discount Product" value="{{ $foundProduct->discount }}" required>
        </div>
        <div class="flex flex-row label_content_product items-center">
            <span class="w-1/5 font-bold">
                Number of Product
            </span>
            <input type="number" class="w-2/5 input_auth_username m-0" name="number_of_product"
                   placeholder="Price Product" value="{{ $foundProduct->number_of_product }}" required>
        </div>
        <div class="flex flex-row label_content_product items-center">
            <span class="w-1/5 font-bold">
                Status
            </span>
            <div class="flex flex-row items-center gap-[12px]">
                <div class="flex flex-row items-center gap-[4px]">
                    <input type="radio" {{ $foundProduct->status_product == 1 ? 'checked' : ''}} value="1" name="status_product">
                    <label for="status_product" class="content_product uppercase">available</label>
                </div>
                <div class="flex flex-row items-center gap-[4px]">
                    <input type="radio" {{ $foundProduct->status_product == 2 ? 'checked' : ''}} value="2" name="status_product">
                    <label for="status_product" class="content_product uppercase">not available</label>
                </div>
            </div>
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
                        <input type="checkbox" {{$check ? 'checked' : ''}} value="{{$genre->id}}" name="genre[]">
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
                @foreach($imageList as $index=>$image)
                    @if($loop->first)
                        <div class="flex flex-row justify-between">
                            <img class="image_border w-1/2" id="img{{$index + 1}}" src="{{ asset('storage/product_image/' . $foundProduct->id . '/' . $image) }}" alt="">
                            <div class="flex flex-col w-[49%] gap-[1rem]">
                                <span class="text-[red]">
                                    *This image will show as the main image of product
                                </span>
                                <input type="file" style="display: none" accept="image/jpeg" id="input{{$index + 1}}" onchange="uploadImage({{$index + 1}}, this)" name="imageUpload[]" >
                                <label for="input{{$index + 1}}" class="custom-file-input custom-file-input-edit"></label>
                                <input hidden type="text" value="" name="image{{$index + 1}}" id="image{{ $index + 1 }}">
                            </div>

                        </div>
                    @else
                        <div class="flex flex-row justify-between">
                            <img class="image_border w-1/2" id="img{{$index + 1}}" src="{{ asset('storage/product_image/' . $foundProduct->id . '/' . $image) }}" alt="">
                            <div class="flex flex-col w-[49%]">
                                <input type="file" style="display: none" accept="image/jpeg" id="input{{$index + 1}}" onchange="uploadImage({{$index + 1}}, this)" name="imageUpload[]">
                                <label for="input{{$index + 1}}" class="custom-file-input custom-file-input-edit"></label>
                                <input hidden type="text" value="" name="image{{$index + 1}}" id="image{{ $index + 1 }}">
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="flex flex-col items-center justify-center gap-[1rem] mt-[1rem] mb-[1rem]">
            <button class="button-action w-1/4 rounded font-bold">
                <span class="uppercase">
                    Edit
                </span>
            </button>

            <a role="button" href="{{ route('admin.product.list') }}" class="btn dark:bg-gray-800 hover:dark:bg-gray-600 w-1/4 rounded font-bold text-center p-[12px]">
                <span class="uppercase">
                    Back
                </span>
            </a>
        </div>
    </form>
@endsection

@section('script')
    <script src="{{ asset('assets/js/admin/product.js') }}"></script>
@endsection
