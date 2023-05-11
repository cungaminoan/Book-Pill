<?php

namespace App\Service;

use App\Enum\Result;
use App\ResponseObject\ResponseObject;
use App\Service\Repository\CartRepositoryInterface;
use App\Service\Repository\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartService
{
    private CartRepositoryInterface $cartRepository;
    private ProductRepositoryInterface $productRepository;

    /**
     * @param CartRepositoryInterface $cartRepository
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        CartRepositoryInterface $cartRepository,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
    }

    public function getCartList(Request $request)
    {
        if($request->ajax()) {
            if(!Auth::user()->cart) {
                $result = $this->cartRepository->createCart(Auth::id());

                if(!$result) {
                    $cartResponse = new ResponseObject(Result::FAILURE, '', '');

                    return response()->json($cartResponse->responseObject());
                }

                $data = $this->responseCartList([]);

                $cartResponse = new ResponseObject(Result::SUCCESS, $data, '');

                return response()->json($cartResponse->responseObject());
            }

            $productIDList = json_decode(Auth::user()->cart->product_id);

            $foundProduct = $this->productRepository->getProductByIDList($productIDList);

            $data = $this->responseCartList($foundProduct);

            $cartResponse = new ResponseObject(Result::SUCCESS, $data, '');

            return response()->json($cartResponse->responseObject());
        }

        $productIDList = json_decode(Auth::user()->cart->product_id);

        $foundProduct = $this->productRepository->getProductByIDList($productIDList);

        return view('pages.profile.cart', compact('foundProduct'));
    }

    public function addProductToCart(Request $request)
    {
        $idProduct = $request->id_product;
        $productList = collect(json_decode(Auth::user()->cart->product_id));

        $checkId = $productList->first(function ($value, $key) use ($idProduct) {
            return $value == $idProduct;
        });
        if($checkId) {
            $cartResponse = new ResponseObject(Result::FAILURE, '', '');
            return $cartResponse->responseObject();
        }

        if (count($productList) > 0) {
            $productList = json_encode($productList->push($idProduct));
        } else {
            $productList = json_encode(array($idProduct));
        }
        $result = $this->cartRepository->addProductToCart($productList, Auth::user()->cart->id);

        if(!$result) {
            $cartResponse = new ResponseObject(Result::FAILURE, '', '');
            return $cartResponse->responseObject();
        }

        $cartResponse = new ResponseObject(Result::SUCCESS, $result, '');
        return $cartResponse->responseObject();

    }

    public function removeProductFromCart(Request $request)
    {
        $idProduct = $request->id_product;
        $productList = collect(json_decode(Auth::user()->cart->product_id));

        $listProductID = $productList->filter(function ($value, $key) use ($idProduct) {
            return $value != $idProduct;
        });

        $result = $this->cartRepository->addProductToCart(json_encode($listProductID->toArray()), Auth::user()->cart->id);

        if(!$result) {
            $cartResponse = new ResponseObject(Result::FAILURE, '', '');
            return $cartResponse->responseObject();
        }

        $cartResponse = new ResponseObject(Result::SUCCESS, $result, '');
        return $cartResponse->responseObject();
    }

    private function responseCartList($productList) {
        $data = '<div class="flex flex-col">';
        if(count($productList) > 0) {
            $data .= '<span class="text_card"> Recently Added Products </span>';

            foreach ($productList as $product) {
                $data .= '<div class="flex flex-row justify-between cart_item"> <img width=10%" src="'
                    . asset('storage/product_image/' . $product->id . '/img1.jpg') . '" alt="">'
                    . '<span class="w-[65%] text-[14px] title_product_in_cart font-bold">' . $product->title . '</span>'
                    .'<span class="w-[17%] text-[14px] text-[#566FEF] break-words">'
                    . '₫' . $product->price . '</span> </div>';

            }
            return $data .= '</div>';
        }

        return $data .= '<div class="flex flex-row items-center justify-center">'
            . '<img width=60%" src="' . asset('storage/product_image/no_product.png') . '" alt="">'
            . '</div> </div>';
    }
}
