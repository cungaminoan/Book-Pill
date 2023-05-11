<?php

namespace App\Service;

use App\Enum\Result;
use App\ResponseObject\ResponseObject;
use App\Service\Repository\CommentRepositoryInterface;
use App\Service\Repository\OrderRepositoryInterface;
use App\Service\Repository\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentService
{

    private CommentRepositoryInterface $commentRepository;

    private OrderRepositoryInterface $orderRepository;

    private ProductRepositoryInterface $productRepository;

    /**
     * @param CommentRepositoryInterface $commentRepository
     * @param OrderRepositoryInterface $orderRepository
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        CommentRepositoryInterface $commentRepository,
        OrderRepositoryInterface $orderRepository,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->commentRepository = $commentRepository;
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
    }

    public function getCommentProduct(Request $request)
    {
        $commentList = $this->commentRepository->getCommentProduct($request->rating, $request->idProduct);
        $data = view('partial.comment', compact('commentList'))->render();
        $response = new ResponseObject(Result::SUCCESS, $data, '');
        if(!$commentList) {
            $response = new ResponseObject(Result::FAILURE, '', 'Cannot get product message!');
        }
        return response()->json($response->responseObject());
    }

    public function addCommentProduct(Request $request)
    {
        $productID = (int) $request->id_product;
        $comment = $request->comment;
        $rating = (int) $request->rating;
        $idOrder = $request->idOrder;
        $result = $this->commentRepository->addCommentProduct(Auth::id(), $productID, $comment, $rating);

        if(!$result) {
            $response = new ResponseObject(Result::FAILURE, '', 'Can not upload your comment!');
            return response()->json($response->responseObject());
        }

        $order = $this->orderRepository->getOrderByID($idOrder);

        $order->order_info = json_decode($order->order_info);
        foreach ($order->order_info as $order_info) {
            if((int) $order_info->id_product == $productID) {
                $order_info->status = true;
            }
        }

        $resultUpdate =  $this->orderRepository->updateOrder($idOrder, json_encode($order->order_info));

        if (!$resultUpdate) {
            $response = new ResponseObject(Result::FAILURE, '', 'Some error for this action!');
            return response()->json($response->responseObject());
        }

        $product = $this->productRepository->getProductDetail($productID);

        if ($product->rating == 0) {
            $resultRating = $this->productRepository->updateRatingProduct($productID, $rating);
        } else {
            $rating = ($product->rating + $rating) / 2;
            $resultRating = $this->productRepository->updateRatingProduct($productID, $rating);
        }

        if (!$resultRating) {
            $response = new ResponseObject(Result::FAILURE, '', 'Can not upload your comment!');
            return response()->json($response->responseObject());
        }

        $response = new ResponseObject(Result::SUCCESS, '', 'Upload comment successfully!');
        return response()->json($response->responseObject());
    }

}
