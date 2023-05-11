<?php

namespace App\Service\Repository\Eloquent;

use App\Models\Comment;
use App\Service\Repository\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{

    private Comment $comment;

    /**
     */
    public function __construct()
    {
        $this->comment = new Comment();
    }


    public function getCommentProduct($rating, $id)
    {
        try {
            return $this->comment->where(function ($query) use ($id, $rating) {
                $query->where('id_product', $id)
                    ->where('rating', $rating);
            })->orderBy('created_at', 'DESC')->get();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function addCommentProduct($idUser, $idProduct, $comment, $rating)
    {
        try {
            return $this->comment->create(array(
                'id_user' => $idUser,
                'id_product' => $idProduct,
                'comment' => $comment,
                'rating' => $rating
            ));
        } catch (\Exception $e) {
            return false;
        }
    }
}
