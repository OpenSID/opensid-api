<?php

namespace App\Http\Controllers;

use App\Http\Repository\CategoryEntities;
use App\Http\Repository\CategoryEntity;
use App\Http\Transformers\CategoryTransformer;

class CategoryController extends Controller
{
    /** @var CategoryEntities */
    protected $category;

    /**
     * Article controller constructor.
     */
    public function __construct(CategoryEntity $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        return $this->fractal($this->category->get(), new CategoryTransformer(), 'categories');
    }

    public function show(string $slug)
    {
        return $this->fractal($this->category->find($slug), new CategoryTransformer(), 'category');
    }
}
