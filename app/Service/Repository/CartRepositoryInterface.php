<?php

namespace App\Service\Repository;

interface CartRepositoryInterface
{
    public function getCartList($idUser);

    public function addProductToCart($idProduct, $idCart);

    public function createCart($idUser);

    public function updateCart($idUser, $idProduct, $idCart);
}
