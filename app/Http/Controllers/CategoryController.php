<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Http\Transformers\CategoryTransformer;

class CategoryController extends Controller
{
    /**
     * Get all categories.
     *
     * @param CategoryRepositoryInterface $categoryRepository
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(CategoryRepositoryInterface $categoryRepository)
    {
        $categories = $categoryRepository->all();

        $payload = $this->collection($categories, new CategoryTransformer);

        return $this->jsonResponse($payload);
    }

    /**
     * Get a category by it's id.
     *
     * @param                             $id
     * @param CategoryRepositoryInterface $categoryRepository
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($id, CategoryRepositoryInterface $categoryRepository)
    {
        $category = $categoryRepository->find($id);

        $payload = $this->item($category, new CategoryTransformer);

        return $this->jsonResponse($payload);
    }
}
