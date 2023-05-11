<?php

namespace App\Service\Repository\Eloquent;

use App\Models\Cart;
use App\Service\Repository\CartRepositoryInterface;

class CartRepository implements CartRepositoryInterface
{

    private Cart $cart;

    /**
     */
    public function __construct()
    {
        $this->cart = new Cart();
    }


    public function getCartList($idUser)
    {
        try {
            return $this->cart->where('id_user', $idUser)->firstOrFail();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function createCart($idUser)
    {
        try {
            return $this->cart->create(array(
                'id_user' => $idUser,
                'product_id' => json_encode([])
            ));
        } catch (\Exception $e) {
            return false;
        }
    }

    public function addProductToCart($idProduct, $idCart)
    {
        try {
            $this->cart->where('id', $idCart)->update([
                'product_id' => $idProduct
            ]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updateCart($idUser, $idProduct, $idCart)
    {
        try {
            $this->cart->where(function ($query) use ($idCart, $idUser) {
                $query->where('id_user', $idUser)
                    ->where('id', $idCart);
            })->update(array(
                'product_id' => $idProduct
            ));

            return true;

        } catch (\Exception $e) {
            return false;
        }
    }
}
