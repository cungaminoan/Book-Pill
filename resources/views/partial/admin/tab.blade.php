<div class="flex flex-col tab_admin">
    @php($currentUrl = \Illuminate\Support\Facades\URL::current())
    <a href="{{ route('admin.product.list') }}" class="{{ str_contains($currentUrl, 'product') ? 'active_tab' : '' }}">
        <span>
            Product Management
        </span>
    </a>
    <a href="{{ route('admin.user.list') }}" class="{{ str_contains($currentUrl, 'user') ? 'active_tab' : '' }}">
        <span>
            User Management
        </span>
    </a>
    <a href="{{ route('admin.statistical.main') }}" class="{{ str_contains($currentUrl, 'statistical') ? 'active_tab' : '' }}">
        <span>
            Statistical Product
        </span>
    </a>
    <a href="{{ route('admin.order.list') }}" class="{{ str_contains($currentUrl, 'order') ? 'active_tab' : '' }}">
        <span>
            Order Management
        </span>
    </a>
</div>
