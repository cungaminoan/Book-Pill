<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\Admin\OrderAdminService;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{

    private OrderAdminService $orderAdminService;

    /**
     * @param OrderAdminService $orderAdminService
     */
    public function __construct(OrderAdminService $orderAdminService)
    {
        $this->orderAdminService = $orderAdminService;
    }

    public function getOrderList(Request $request)
    {
        return $this->orderAdminService->getOrderList($request);
    }

    public function getOrderDetail(Request $request)
    {
        return $this->orderAdminService->getOrderDetail($request);
    }

    public function handleOrder(Request $request)
    {
        return $this->orderAdminService->handleOrder($request);
    }
}
