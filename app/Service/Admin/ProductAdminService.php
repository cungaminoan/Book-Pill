<?php

namespace App\Service\Admin;

use App\Service\Repository\GenreRepositoryInterface;
use App\Service\Repository\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductAdminService
{
    private ProductRepositoryInterface $productRepository;
    private GenreRepositoryInterface $genreRepository;

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param GenreRepositoryInterface $genreRepository
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        GenreRepositoryInterface $genreRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->genreRepository = $genreRepository;
    }

    public function getProductAdd(Request $request)
    {
        $genreList = $this->genreRepository->getGenre();
        return view('pages.admin.product.add',
            compact('genreList')
        );
    }

    public function addProduct(Request $request)
    {

        if (!$request->inputImageUpload) {
            return redirect()->back()->withInput()->withErrors(array(
                'not_product_image' => 'You must upload image of product'
            ));
        }

        $genre = $request->genre;
        sort($genre);

        $result = $this->productRepository->createProduct(
            $request->title_product,
            json_encode($genre),
            $request->age_range,
            $request->number_of_product,
            $request->discount,
            $request->status_product,
            $request->delivery,
            $request->author_product,
            $request->price
        );

        if (!$result) {
            return false;
        }

        $idLast = $this->productRepository->getLastIDProduct()->id;

        if(!Storage::exists('public/product_image/' . $idLast)) {
            Storage::makeDirectory('public/product_image/' . $idLast);
        }

        foreach ($request->inputImageUpload as $index=>$imageUpload) {
            $this->storageImage($imageUpload, $index + 1, $idLast);
        }

        return redirect()->route('admin.product.detail', ['id' => $idLast]);

    }

    public function getProductList(Request $request)
    {
        if(!$request->searchKey) {
            $key = '%%';
        } else {
            $key = '%' . str_replace('%', '\%', trim($request->searchKey)) . '%';
        }

        $productList = $this->productRepository->getProductAdminList($key);
        return view('pages.admin.product.list', compact('productList'));
    }

    public function getProductDetail(Request $request)
    {
        $foundProduct = $this->productRepository->getProductDetail($request->id);
        $genreList = $this->genreRepository->getGenre();
        $imageList = $this->getImageFile($foundProduct->id);
        $genreProduct = collect(json_decode($foundProduct->genre))->map(function ($genre, $key) {
            return (int) $genre;
        });
        return view('pages.admin.product.detail',
            compact('foundProduct', 'genreList', 'genreProduct', 'imageList')
        );
    }

    public function getProductEdit(Request $request)
    {
        $foundProduct = $this->productRepository->getProductDetail($request->id);
        $genreList = $this->genreRepository->getGenre();
        $imageList = $this->getImageFile($foundProduct->id);
        $genreProduct = collect(json_decode($foundProduct->genre))->map(function ($genre, $key) {
            return (int) $genre;
        });
        return view('pages.admin.product.edit',
            compact('foundProduct', 'genreList', 'genreProduct', 'imageList')
        );
    }

    public function editProduct(Request $request)
    {
        $genre = $request->genre;
        sort($genre);

        $result = $this->productRepository->updateProduct(
            $request->product_id,
            $request->title_product,
            json_encode($genre),
            $request->age_range,
            $request->number_of_product,
            $request->discount,
            $request->status_product,
            $request->delivery,
            $request->author_id,
            $request->price
        );

        if (!$result) {
            return false;
        }

        if($request->image1) {
            $this->replaceImage($request->image1, $request->product_id, 'img1.jpg');
        }

        if($request->image2) {
            $this->replaceImage($request->image2, $request->product_id, 'img2.jpg');
        }

        if($request->image3) {
            $this->replaceImage($request->image3, $request->product_id, 'img3.jpg');
        }

        if($request->image4) {
            $this->replaceImage($request->image4, $request->product_id, 'img4.jpg');
        }

        return redirect()->route('admin.product.detail', ['id' => $request->product_id]);
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

    public function storageImage($image, $index, $idProduct) {
        $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
        $img = str_replace(' ', '+', $img);

        $imageFileName = 'img' . $index . '.jpg';
        Storage::put('public/product_image/' . $idProduct . '/'
            . $imageFileName, base64_decode($img));
    }

    public function replaceImage($image, $idProduct, $imageRemove) {
        Storage::delete('public/product_image/' . $idProduct . '/' . $imageRemove);
        $img = preg_replace('/^data:image\/\w+;base64,/', '', $image);
        $img = str_replace(' ', '+', $img);

        $imageFileName = $imageRemove;

        Storage::put('public/product_image/' . $idProduct . '/'
            . $imageFileName, base64_decode($img));
    }
}
