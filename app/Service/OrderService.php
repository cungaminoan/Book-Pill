<?php

namespace App\Service;

use App\Enum\Result;
use App\ResponseObject\ResponseObject;
use App\Service\Repository\CartRepositoryInterface;
use App\Service\Repository\OrderRepositoryInterface;
use App\Service\Repository\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    private OrderRepositoryInterface $orderRepository;
    private ProductRepositoryInterface $productRepository;
    private CartRepositoryInterface $cartRepository;

    /**
     * @param OrderRepositoryInterface $orderRepository
     * @param ProductRepositoryInterface $productRepository
     * @param CartRepositoryInterface $cartRepository
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        ProductRepositoryInterface $productRepository,
        CartRepositoryInterface $cartRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
        $this->cartRepository = $cartRepository;
    }

    public function createOrder(Request $request)
    {

        if(!trim($request->address)) {
            $target = array('target' => 'address');
            $response = new ResponseObject(Result::FAILURE, json_encode($target), '');
            return response()->json($response->responseObject());
        }

        $result = $this->orderRepository->createOrder(
            Auth::id(),
            $request->orderInfo,
            $request->address,
            $request->priceOrder
        );

        if (!$result) {
            $response = new ResponseObject(Result::FAILURE, '', 'Cannot place order!');
            return response()->json($response->responseObject());
        }

        $productNotRemove = array_diff(
            json_decode(Auth::user()->cart->product_id),
            json_decode($request->productIDList)
        );

        $this->cartRepository->updateCart(
            Auth::id(),
            json_encode($productNotRemove),
            Auth::user()->cart->id
        );

        $response = new ResponseObject(Result::SUCCESS, '', 'Place order successfully!');
        return response()->json($response->responseObject());
    }

    public function getOrder(Request $request)
    {
        $foundOrder = $this->orderRepository->getOrderByIDUser(Auth::id());
        foreach ($foundOrder as $index=>$order) {
            $order->order_info = json_decode($order->order_info);
            foreach ($order->order_info as $order_info) {
                $order_info->title = $this->productRepository->getTitleProductByID(
                    $order_info->id_product
                )->title;
            }
        }
        return view('pages.profile.order', compact('foundOrder'));
    }

    public function createOrderTmp(Request $request)
    {
        $listID = collect([]);
        $order_info = collect(json_decode($request->order_info));
        foreach ($order_info as $info) {
            $listID->push($info->idProduct);
        }

        $totalSub = 0;

        $productList = $this->productRepository->getProductByIDList($listID);

        if(!$productList) {
            $response = new ResponseObject(Result::FAILURE, '', '');
            return response()->json($response->responseObject());
        }

        foreach ($productList as $key=>$product) {
            $product->quantity = $order_info->get($key)->quantity;
            $product->discount > 0.0
                ? $product->subTotal = ($product->price - ($product->price * ($product->discount / 100))) * $order_info->get($key)->quantity
                : $product->subTotal = $product->price * $order_info->get($key)->quantity;
            $product->discount > 0.0
                ? $product->unitPrice = $product->price - ($product->price * ($product->discount / 100))
                : $product->unitPrice = $product->price;

            $totalSub += $product->subTotal;
        }

        $shippingPrice = 30000;
        $totalOrder = $totalSub + 30000;

        $response = view('pages.profile.order_tmp', compact(
            'productList', 'totalOrder', 'shippingPrice', 'totalSub')
        )->render();
        $response = new ResponseObject(Result::SUCCESS, $response, '');
        return response()->json($response->responseObject());
    }
}
