<?php

namespace App\Service\Admin;

use App\Enum\Result;
use App\ResponseObject\ResponseObject;
use App\Service\Repository\OrderRepositoryInterface;
use App\Service\Repository\ProductRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticalAdminService
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


    public function statisticalProduct(Request $request)
    {
        return view('pages.admin.statistical.main');
    }

    public function calculateStatisticalProduct(Request $request)
    {
        $statisticalData = $this->orderRepository->statisticalProduct($request->month, $request->year);

        $day = array_column($statisticalData, 'statistical_day');
        $price = array_column($statisticalData, 'price');

        $countOrderProduct = 0;

        if($statisticalData) {
            $orderInfo = $this->orderRepository->statisticalOrderInfo($request->month, $request->year);
            foreach ($orderInfo as $order) {
                $orderData = json_decode($order->order_info);
                foreach ($orderData as $orderEle) {
                    $countOrderProduct += $orderEle->quantity;
                }
            }
        }

        $arrayValue = [];

        $j = 0;
        for ($i = 1; $i <= 31; $i++) {
            $position = in_array($i, $day);
            if ($position) {
                array_push($arrayValue, (int) $price[$j]);
                $j++;
            } else {
                array_push($arrayValue, 0);
            }
        }

        $countProductWarehouse = $this->productRepository->countProductWarehouse()[0]->countProduct;

        $topSeller = $this->productRepository->getTopSellerProduct(3);

        $dataTopSeller = '';

        foreach ($topSeller as $top) {
            $dataTopSeller .= '<a href="' . route('admin.product.detail', ['id' => $top->id]) . '">' . $top->title . '</a>';
        }

        $arrayData = [
            'arrayValue' => $arrayValue,
            'countData' => $countOrderProduct,
            'countProductWarehouse' => $countProductWarehouse,
            'dataTopSeller' => $dataTopSeller
        ];

        if(!$statisticalData && $statisticalData != []) {
            $response = new ResponseObject(Result::FAILURE, '', 'Can not get statistical data!');
            return response()->json($response->responseObject());
        }

        $response = new ResponseObject(Result::SUCCESS, $arrayData, '');
        return response()->json($response->responseObject());
    }
}
