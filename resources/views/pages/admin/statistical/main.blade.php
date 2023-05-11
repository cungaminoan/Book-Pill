@extends('layout.admin.master')

@section('content')
    <div class="flex flex-col">
        <div class="mb-[2rem]">
            <input type="month" class="input_auth_username" value="{{ \Carbon\Carbon::now()->format('Y-m') }}" name="statistical_time" id="statistical_time">
        </div>
        <div class="w-full mb-[2rem]">
            <canvas class="w-full" id="statisticalChart">

            </canvas>
        </div>
        <div class="flex flex-col w-full mb-[2rem] items-center text-[24px] font-bold justify-center" >
            <div class="flex flex-row w-full items-center gap-[12px]">
                <span class="w-[55%] text-right">Number of products are sold in <span id="month"></span></span>
                <span class="w-[44%] text-left text-[#566FEF]" id="soldCount">
                </span>
            </div>
            <div class="flex flex-row w-full items-center gap-[12px]">
                <span class="w-[55%] text-right">Number of products in warehouses to now</span>
                <span class="w-[44%] text-left text-[#566FEF]" id="countWareHouse">
                </span>
            </div>
            <div class="flex flex-row w-full gap-[12px]">
                <span class="w-[55%] text-right">Top seller products</span>
                <div class="flex flex-col w-[44%] text-left text-[#566FEF] gap-[8px]" id="topSeller">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        function routeCalculateStatistical() {
            return '{{ route('admin.statistical.calculate') }}'
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="module" src="{{ asset('assets/js/admin/statistical.js') }}"></script>
@endsection
