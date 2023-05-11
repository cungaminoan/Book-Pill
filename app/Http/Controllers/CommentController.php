<?php

namespace App\Http\Controllers;

use App\Service\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private CommentService $commentService;

    /**
     * @param CommentService $commentService
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function addCommentProduct(Request $request)
    {
        return $this->commentService->addCommentProduct($request);
    }

    public function getCommentProduct(Request $request)
    {
        return $this->commentService->getCommentProduct($request);
    }

}
