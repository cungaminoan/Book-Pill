<?php

namespace App\Service;

use App\Service\Repository\OrderRepositoryInterface;
use App\Service\Repository\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaserService
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

    public function getPurchaser(Request $request)
    {
        $purchaserList = $this->orderRepository->getPurchaserUser(Auth::id());
        foreach ($purchaserList as $index=>$purchaser) {
            $purchaser->order_info = json_decode($purchaser->order_info);
            foreach ($purchaser->order_info as $order_info) {
                $order_info->title = $this->productRepository->getTitleProductByID(
                    $order_info->id_product
                )->title;
            }
        }
        return view('pages.profile.purchaser', compact('purchaserList'));
    }

}
