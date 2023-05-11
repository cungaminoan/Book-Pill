<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\Admin\ProductAdminService;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    private ProductAdminService $productAdminService;

    /**
     * @param ProductAdminService $productAdminService
     */
    public function __construct(ProductAdminService $productAdminService)
    {
        $this->productAdminService = $productAdminService;
    }

    public function getProductAdd(Request $request)
    {
        return $this->productAdminService->getProductAdd($request);
    }

    public function addProduct(Request $request)
    {
        return $this->productAdminService->addProduct($request);
    }

    public function getProductList(Request $request)
    {
        return $this->productAdminService->getProductList($request);
    }

    public function getProductDetail(Request $request)
    {
        return $this->productAdminService->getProductDetail($request);
    }

    public function getProductEdit(Request $request)
    {
        return $this->productAdminService->getProductEdit($request);
    }

    public function editProduct(Request $request)
    {
        return $this->productAdminService->editProduct($request);
    }

}
