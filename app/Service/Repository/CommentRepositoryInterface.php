<?php

namespace App\Service\Repository;

interface CommentRepositoryInterface
{
    public function getCommentProduct($rating, $id);

    public function addCommentProduct($idUser, $idProduct, $comment, $rating);
}
