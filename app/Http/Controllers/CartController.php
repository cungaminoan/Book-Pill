<?php

namespace App\Http\Controllers;

use App\Service\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private CartService $cartService;

    /**
     * @param CartService $cartService
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function getCartList(Request $request)
    {
        return $this->cartService->getCartList($request);
    }

    public function addProductToCart(Request $request)
    {
        return $this->cartService->addProductToCart($request);
    }

    public function removeProductFromCart(Request $request)
    {
        return $this->cartService->removeProductFromCart($request);
    }

}
