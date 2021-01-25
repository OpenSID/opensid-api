<?php

namespace App\Http\Controllers;

use App\Http\Repository\CommentEntity;
use App\Http\Transformers\CommentTransformer;

class CommentController extends Controller
{
    /** @var CommentEntity $comment */
    protected $comment;

    /**
     * Article controller constructor.
     */
    public function __construct(CommentEntity $comment)
    {
        $this->comment = $comment;
    }

    public function index()
    {
        return $this->fractal($this->comment->get(), new CommentTransformer(), 'comments');
    }

    public function show(int $id)
    {
        return $this->fractal($this->comment->find($id), new CommentTransformer(), 'comment');
    }
}
