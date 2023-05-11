<?php

namespace App\Service;

use App\Service\Repository\GenreRepositoryInterface;
use App\Service\Repository\OrderRepositoryInterface;
use App\Service\Repository\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    private ProductRepositoryInterface $productRepository;
    private GenreRepositoryInterface $genreRepository;

    private OrderRepositoryInterface $orderRepository;

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param GenreRepositoryInterface $genreRepository
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        GenreRepositoryInterface $genreRepository,
        OrderRepositoryInterface $orderRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->genreRepository = $genreRepository;
        $this->orderRepository = $orderRepository;
    }

    public function getProductList(Request $request)
    {
        $productList = $this->productRepository->getProductList();

        $topSeller = $this->productRepository->getTopSellerProduct(5);

        $genreList = $this->genreRepository->getGenre();

        $idList = collect();

        if(Auth::check()) {

            $orderInfo = Auth::user()->order;

            foreach ($orderInfo as $order) {
                $orderData = json_decode($order->order_info);

                foreach ($orderData as $data) {
                    $idList->push($data->id_product);
                }

            }

            $genreRecommend = [];

            $idList = $idList->unique();

            $productRecommend = $this->productRepository->getProductByIDList($idList);

            foreach ($productRecommend as $product) {
                $genreRecommend = array_merge($genreRecommend, json_decode($product->genre));
            }

            $genreTmp = array_count_values($genreRecommend);

            sort($genreTmp);

            $genres = array_slice($genreTmp, -3, 3, true);

            $genreTmp = [];

            foreach ($genres as $key=>$genre) {
                array_push($genreTmp, $key);
            }

            $query = '';

            $index = 0;

            foreach ($genreTmp as $genre) {
                if ($index > 0 && $index < (count($genreTmp))) {
                    $query .= ' OR ';
                    $query .= ' genre LIKE "%' . $genre . '%" ';
                } else {
                    $query .= ' genre LIKE "%' . $genre . '%" ';
                }
                $index++;
            }

            if(!$query) {
                return view('pages.product.main')->with(array(
                    'productList' => $productList,
                    'genreList' => $genreList,
                    'topSeller' => $topSeller
                ));
            }

            $recommendProductList = $this->productRepository->getRecommendProduct($query);

            return view('pages.product.main')->with(array(
                'productList' => $productList,
                'genreList' => $genreList,
                'topSeller' => $topSeller,
                'recommendProductList' => $recommendProductList
            ));
        }

        return view('pages.product.main')->with(array(
            'productList' => $productList,
            'genreList' => $genreList,
            'topSeller' => $topSeller
        ));
    }

    public function getProductBySearchKey(Request $request)
    {
        $key = '%' . trim($request->key) . '%';
        $productList = $this->productRepository->getProductList($key);
        if($key == '%%') {
            $genreList = $this->genreRepository->getGenre();

            return view('pages.product.main')->with(array(
                'productList' => $productList,
                'genreList' => $genreList
            ));
        }

        $search = trim($request->key);

        return view('pages.product.main', compact('productList', 'search'));
    }

    public function getProductDetail(Request $request)
    {
        $foundProduct = $this->productRepository->getProductDetail($request->id);

        if (!$foundProduct) {
            return redirect()->route('error');
        }

        $imageList = $this->getImageFile($request->id);

        $genre = json_decode($foundProduct->genre);

        $genreList = $this->genreRepository->getGenreByProduct($genre);

        $genreProduct = '';

        if ( count($genre) > 0) {
//            foreach ($genre as $ele) {
                $genreProduct .= '%"' . $genre[0] . '"%';
//            }
        } else {
            $genreProduct .= '%%';
        }

        $relatedProduct = $this->productRepository->getRelatedProduct(
            $genreProduct,
            $foundProduct->age,
            $foundProduct->author,
            $foundProduct->id
        );

        return view('pages.product.detail')->with(array(
            'product' => $foundProduct,
            'imageProduct' => $imageList,
            'genreList' => $genreList,
            'relatedProduct' => $relatedProduct
        ));
    }

    public function getProductFilter(Request $request)
    {
        if(!$request->clear) {
            $data = json_decode($request->data);
            $genre = '';
            if ( count($data->genreList) > 0) {
                foreach ($data->genreList as $genreItem) {
                    $genre .= '%"';
                    $genre .= $genreItem;
                    $genre .= '"%';
                }
            } else {
                $genre .= '%%';
            }

            $data->genreList = $genre;

            $foundProduct = $this->productRepository->getProductByFilter($data);

            $dataResponse = $this->dataResponseProduct($foundProduct);

        } else {
            $foundProduct = $this->productRepository->getProductList();
            $dataResponse = $this->dataResponseProduct($foundProduct);
        }

        return response()->json(array(
            'result' => 1,
            'data' => $dataResponse,
        ));
    }

    public function getProductTitle(Request $request)
    {
        $searchKey = '%'. str_replace( '%', '\%', $request->searchKey) . '%';

        $foundTitleProductList = $this->productRepository->getTitleProduct($searchKey);

        $data = $this->dataResponseTitleProduct($foundTitleProductList);

        return response()->json(array(
            'result' => 1,
            'data' => $data
        ));
    }

    private function getImageFile($id)
    {
        $fileList = collect();

        $files = Storage::files('public/product_image/' . $id);

        foreach ($files as $file)
        {
            $fileList->push(basename($file));
        }

        return $fileList;
    }

    private function dataResponseProduct($productList)
    {
        $dataResponse = '';

        if($productList->count() > 0) {
            $dataResponse = '<div class="product_list_search grid grid-cols-5 mt-[2rem] gap-[8px]">';
            foreach ($productList as $product) {
                $dataResponse .= view('partial.product_card', compact('product'))->render();
            }
            $dataResponse .= '</div>';
        } else {
            $dataResponse .= '<img src="' . asset("storage/product_image/no-product-found-image.png") . '">';
        }

        return $dataResponse;
    }

    private function dataResponseTitleProduct($productTitleList)
    {
        $dataResponse = '';

        if($productTitleList->count() > 0) {
            foreach ($productTitleList as $productTitle) {
                $dataResponse .= '<a href="' . route('product.detail', ['id' => $productTitle->id])
                    . '" class="flex flex-row items-center">' .'<span>' . $productTitle->title . '</span>' .'</a>';
            }
        } else {
            $dataResponse .= '<div class="flex flex-col no_title_product_found justify-center items-center">'
                . '<span> No Product Found </span> </div>';
        }

        return $dataResponse;
    }

    public function getProductByGenre(Request $request)
    {
        $genre = '%' . $request->genre . '%';
        $productList = $this->productRepository->getProductByGenre($genre);
        return view('pages.product.main', compact('productList'));
    }

    public function getProductByAuthor(Request $request)
    {
        $productList =  $this->productRepository->getProductByAuthor($request->author);
        return view('pages.product.main', compact('productList'));
    }

}
