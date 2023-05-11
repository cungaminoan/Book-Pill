@extends('layout.admin.master')

@section('content')
    <div class="flex flex-col gap-[1rem]">
        <div class="flex flex-row items-center">
            <form action="{{ route('admin.order.list') }}" class="flex flex-row w-[35%] items-center gap-[0.5rem]">
                <input type="text" class="w-4/5 input_auth_username m-0" name="searchKey" placeholder="Username">
                <button class="button-action rounded font-bold">
                    <span>
                        Search
                    </span>
                </button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <td width="20%">
                        User Order
                    </td>
                    <td width="19%">
                        Price Order
                    </td>
                    <td width="30%">
                        Address Delivery
                    </td>
                    <td width="21%">
                        Time Order
                    </td>
                    <td width="10%">
                        Action
                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach($orderList as $order)
                    <tr>
                        <td><span>{{ $order->user->username }}</span></td>
                        <td>
                            <span class="price_product">{{ $order->price_order }}</span>
                        </td>
                        <td>
                            <span>
                                {{ $order->address }}
                            </span>
                        </td>
                        <td>
                            <span>
                                {{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d H:m:s') }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.order.detail', ['id' => $order->id]) }}" role="button" class="btn btn-info">
                                <span>
                                    Info
                                </span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="flex flex-row items-center justify-center mb-[1rem]">
            {!! $orderList->links() !!}
        </div>
    </div>
@endsection
