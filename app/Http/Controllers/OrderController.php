<?php

namespace App\Http\Controllers;

use App\Service\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private OrderService $orderService;

    /**
     * @param OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function createOrder(Request $request)
    {
        return $this->orderService->createOrder($request);
    }

    public function getOrder(Request $request)
    {
        return $this->orderService->getOrder($request);
    }

    public function createOrderTmp(Request $request)
    {
        return $this->orderService->createOrderTmp($request);
    }
}
