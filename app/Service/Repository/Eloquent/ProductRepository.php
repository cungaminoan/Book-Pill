<?php

namespace App\Service\Repository\Eloquent;

use App\Models\Product;
use App\Service\Repository\ProductRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductRepository implements ProductRepositoryInterface
{
    private Product $product;

    /**
     */
    public function __construct()
    {
        $this->product = new Product();
    }

    public function getProductList($searchKey = '%%')
    {
        try {
            return $this->product->where(function ($query) use ($searchKey) {
                $query->where('status_product', 1)
                    ->where('title', 'LIKE', $searchKey);
            })->orderBy('title')->get();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getProductDetail($id) {
        try {
            return $this->product->where('id', $id)->first();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getProductByFilter($filter)
    {
        try {
            return $this->product->where(function ($query) use ($filter){
                $query->whereIn('delivery', $filter->deliveryFrom)
                    ->where('price', '>=', $filter->min_price)
                    ->where('price', '<=', $filter->max_price ?: 99999999999999999)
                    ->where('genre', 'LIKE', $filter->genreList);
            })->orderBy('title')->get();
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }

    public function getTitleProduct($searchKey)
    {
        try {
            return $this->product->select('id', 'title')->where('title', 'LIKE', $searchKey)->orderBy('title')->get();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getProductByIDList($idProductList)
    {
        try {
            return $this->product->whereIn('id', $idProductList)->get();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getProductAdminList($searchKey = '')
    {
        try {
            return $this->product->where('title', 'LIKE', $searchKey)->orderBy('updated_at', 'DESC')->paginate(5);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getTitleProductByID($idProduct)
    {
        try {
            return $this->product->select('title')->where('id', $idProduct)->first();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getRelatedProduct($genre, $ageRange, $author, $id)
    {
        try {
            return $this->product->where(function ($query) use ($genre, $ageRange, $author, $id){
                $query->where('id', '<>', $id)
                    ->where('genre', 'LIKE', $genre);
//                    ->orWhere('author', $author)
//                    ->orWhere('age', $ageRange);
            })->take(3)->orderBy('rating', 'DESC')->get();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function createProduct($title, $genre, $ageRange, $numberOfProduct, $discount, $status, $delivery, $author, $price)
    {
        try {
            return $this->product->insert(array(
                array(
                    'title' => $title,
                    'author' => $author,
                    'delivery' => $delivery,
                    'price' => $price,
                    'discount' => $discount,
                    'status_product' => $status,
                    'genre' => $genre,
                    'age' => $ageRange,
                    'rating' => 0.0,
                    'sold' => 0,
                    'number_of_product' => $numberOfProduct,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                )
            ));
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getLastIDProduct() {
        try {
            return $this->product->orderBy('id', 'DESC')->first();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updateProduct($id, $title, $genre, $ageRange, $numberOfProduct, $discount, $status, $delivery, $author, $price)
    {
        try {
            $this->product->where('id', $id)->update(array(
                'title' => $title,
                'author' => $author,
                'delivery' => $delivery,
                'price' => $price,
                'discount' => $discount,
                'status_product' => $status,
                'genre' => $genre,
                'age' => $ageRange,
                'number_of_product' => $numberOfProduct,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ));

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updateNumberProduct($number, $id)
    {
        try {
             $this->product->where('id', $id)
                 ->update(array(
                     'sold' => DB::raw('sold + ' . $number),
                     'number_of_product' => DB::raw('number_of_product - ' . $number)
                 ));
             return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updateRatingProduct($id, $rating)
    {
        try {
            $this->product->where('id', $id)->update(array(
                'rating' => $rating
            ));
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getProductByGenre($genre)
    {
        try {
            return $this->product->where('genre', 'LIKE', $genre)->orderBy('title')->get();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getProductByAuthor($author)
    {
        try {
            return $this->product->where('author', $author)->orderBy('title')->get();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function countProductWarehouse()
    {
        try {
            DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
            return DB::select('
                SELECT SUM(number_of_product) - SUM(sold) as countProduct FROM `product`');
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getTopSellerProduct($number)
    {
        try {
            return $this->product->orderBy('sold', 'DESC')->take($number)->get();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getRecommendProduct($query)
    {
        try {
            return $this->product->whereRaw($query)->orderBy('sold', 'DESC')->take(5)->get();
        } catch (\Exception $e) {
            return false;
        }
    }
}
