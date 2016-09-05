<?php

namespace App\Contracts\Repositories;


use App\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface CategoryRepositoryInterface
{
    /**
     * Find a category given it's id.
     *
     * @param $id
     *
     * @return Category
     * @throws ModelNotFoundException
     */
    public function find($id);

    /**
     * Get a collection of all categories.
     *
     * @return Collection
     */
    public function all();
}
