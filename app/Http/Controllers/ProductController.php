<?php

namespace App\Http\Controllers;

use App\Service\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductService $productService;

    /**
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getProductList(Request $request)
    {
        return $this->productService->getProductList($request);
    }

    public function getProductDetail(Request $request)
    {
        return $this->productService->getProductDetail($request);
    }

    public function getProductFilter(Request $request)
    {
        return $this->productService->getProductFilter($request);
    }

    public function getProductTitle(Request $request)
    {
        return $this->productService->getProductTitle($request);
    }

    public function getProductBySearchKey(Request $request)
    {
        return $this->productService->getProductBySearchKey($request);
    }

    public function getProductByGenre(Request $request)
    {
        return $this->productService->getProductByGenre($request);
    }

    public function getProductByAuthor(Request $request)
    {
        return $this->productService->getProductByAuthor($request);
    }
}
