<?php

namespace App\Service\Repository;

interface ProductRepositoryInterface
{
    public function getProductList($searchKey);

    public function getProductAdminList($searchKey);

    public function getProductDetail($id);

    public function getProductByFilter($filter);

    public function getTitleProduct($searchKey);
    public function getTitleProductByID($idProduct);


    public function getProductByIDList($idProductList);

    public function getRelatedProduct($genre, $ageRange, $author, $id);

    public function createProduct($title, $genre, $ageRange, $numberOfProduct, $discount, $status, $delivery, $author, $price);

    public function getLastIDProduct();

    public function updateNumberProduct($number, $id);

    public function updateRatingProduct($id, $rating);

    public function updateProduct($id, $title, $genre, $ageRange, $numberOfProduct, $discount, $status, $delivery, $author, $price);

    public function getProductByGenre($genre);

    public function getProductByAuthor($author);

    public function countProductWarehouse();

    public function getTopSellerProduct($number);

    public function getRecommendProduct($query);
}
