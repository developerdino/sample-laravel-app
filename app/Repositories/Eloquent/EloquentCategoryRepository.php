<?php

namespace App\Repositories\Eloquent;


use App\Category;
use App\Contracts\Repositories\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentCategoryRepository implements CategoryRepositoryInterface
{
    /**
     * Find a category given it's id.
     *
     * @param $id
     *
     * @return Category
     * @throws ModelNotFoundException
     */
    public function find($id)
    {
        return Category::findOrFail($id);
    }

    /**
     * Get a collection of all categories.
     *
     * @return Collection
     */
    public function all()
    {
        return Category::all();
    }
}
