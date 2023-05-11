<div class="flex flex-row items-center justify-between product_cart checkout_cart">
    <div>
        &nbsp
    </div>
    <div class="flex flex-row w-1/2 justify-between items-center">
        <div class="flex flex-col w-[49%]">
            <div class="flex flex-row items-center justify-between">
                <span class="text-[#566FEF] w-[49%] text-[1.125rem]">
                    Total (<span id="totalNumber"> 0 </span> items):
                </span>
                <span class="flex flex-row-reverse text-[#566FEF] w-1/2 text-[1.5rem]" id="totalOrder">0</span>
            </div>
            <div class="flex flex-row-reverse gap-[0.5rem] items-center savedMoney" style="display:none;">
                <span class="text-[#566FEF]" id="savedMoney">0</span>
                <span class="text-[#566FEF]">
                    Saved
                </span>
            </div>
        </div>

        <button class="disabled_button button-action rounded w-[49%] font-bold " id="check_out" disabled>
            <span>
                Check out
            </span>
        </button>
    </div>
</div>

<script type="text/javascript">
    function getUserID() {
        return "{{ \Illuminate\Support\Facades\Auth::id() }}"
    }

    function routeOrderTmp() {
        return '{{ route("account.creat_order_tmp") }}'
    }

    function getUserPhoneNumber() {
        return "{{ \Illuminate\Support\Facades\Auth::user()->phone_number }}"
    }
</script>
