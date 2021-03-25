<?php

namespace App\Http\Controllers;

use App\Http\Repository\ArticleEntity;
use App\Http\Transformers\ArticleTransformer;

class ArticleController extends Controller
{
    /** @var ArticleEntity */
    protected $article;

    /**
     * Article controller constructor.
     */
    public function __construct(ArticleEntity $article)
    {
        $this->article = $article;
    }

    public function index()
    {
        return $this->fractal($this->article->get(), new ArticleTransformer(), 'articles');
    }

    public function show(string $slug)
    {
        return $this->fractal($this->article->find($slug), new ArticleTransformer(), 'article');
    }

    public function headline()
    {
        return $this->fractal($this->article->headline(), new ArticleTransformer(), 'headline');
    }
}
