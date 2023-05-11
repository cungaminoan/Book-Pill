<?php

namespace App\Service\Admin;

use App\Enum\Result;
use App\ResponseObject\ResponseObject;
use App\Service\Repository\OrderRepositoryInterface;
use App\Service\Repository\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderAdminService
{
    private OrderRepositoryInterface $orderRepository;
    private ProductRepositoryInterface $productRepository;

    /**
     * @param OrderRepositoryInterface $orderRepository
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
    }

    public function getOrderList(Request $request)
    {
        $key = str_replace('%', '\%', trim($request->searchKey));
        if ($key != null) {
            $key = '%' . $key . '%';
        } else {
            $key = '%%';
        }
        $orderList = $this->orderRepository->getOrderList($key);
        return view('pages.admin.cart.list', compact('orderList'));
    }

    public function getOrderDetail(Request $request)
    {
        $foundOrder = $this->orderRepository->getOrderByID($request->id);
        $foundOrder->order_info = json_decode($foundOrder->order_info);
        foreach ($foundOrder->order_info as $order_info) {
            $order_info->title = $this->productRepository->getTitleProductByID(
                $order_info->id_product
            )->title;
        }
        return view('pages.admin.cart.detail', compact('foundOrder'));
    }

    public function handleOrder(Request $request)
    {
        $idOrder = (int) $request->id_order;
        $statusOrder = (int) $request->status_order;
        $result = $this->orderRepository->updateStatusOrder($idOrder, $statusOrder);
        if ($result) {
            $foundOrder = $this->orderRepository->getOrderByID($request->id_order);
            $foundOrder->order_info = json_decode($foundOrder->order_info);


            foreach ($foundOrder->order_info as $order_info) {
                $this->productRepository->updateNumberProduct($order_info->quantity, $order_info->id_product);
            }


            $response = new ResponseObject(Result::SUCCESS, '', 'Handle order successfully!');
            return response()->json($response->responseObject());
        }

        $response = new ResponseObject(Result::FAILURE, '', 'Can not handle order!');
        return response()->json($response->responseObject());
    }
}
