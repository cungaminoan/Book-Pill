@extends('layout.admin.master')

@section('content')
    <div class="flex flex-col product_list_admin">
        <div class="flex flex-row items-center justify-between mb-[1rem]">
            <form action="{{ route('admin.product.list') }}" method="GET" class="flex w-[35%] flex-row items-center justify-between">

                <input type="text" class="w-4/5 input_auth_username mb-[0] mr-[8px]" name="searchKey" placeholder="Title Product">

                <button class="button-action rounded font-bold">
                    <span>
                        Search
                    </span>
                </button>
            </form>

            <a role="button" href="{{ route('admin.product.add') }}" class="w-[202px] button-action rounded font-bold">
                <i class="fa-solid fa-plus"></i>
                <span>
                    Add New Product
                </span>
            </a>
        </div>

        <table class="mb-[1rem]">
            <thead>
                <tr>
                    <td>
                        Title
                    </td>
                    <td>
                        Image
                    </td>
                    <td>
                        Author
                    </td>
                    <td>
                        Price
                    </td>
                    <td>
                        Update At
                    </td>
                    <td>
                        Action
                    </td>
                </tr>
            </thead>
            <tbody>
            @foreach($productList as $product)
                <tr>
                    <td width="26%">
                        {{$product->title}}
                    </td>
                    <td width="16%">
                        <img src="{{ asset('storage/product_image/' . $product->id . '/img1.jpg') }}" alt="">
                    </td>
                    <td width="16%">
                        {{ $product->authorProduct->author_name }}
                    </td>
                    <td width="14%">
                        {{ $product->price }}
                    </td>
                    <td width="18%">
                        {{ $product->updated_at }}
                    </td>
                    <td width="10%" class="text-center">
                        <div class="flex flex-col gaps-[8px] items-center justify-center">
                            <a role="button" href="{{ route('admin.product.detail', ['id' => $product->id]) }}" class="btn btn-info">
                                Info
                            </a>
                            <a role="button" href="{{ route('admin.product.edit', ['id' => $product->id]) }}" class="btn btn-edit">
                                Edit
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="flex flex-row items-center justify-center mt-[1rem] mb-[1rem]">
            {!! $productList->links() !!}
        </div>
    </div>
@endsection
