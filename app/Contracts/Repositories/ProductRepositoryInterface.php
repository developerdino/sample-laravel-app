<?php

namespace App\Contracts\Repositories;


use App\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface ProductRepositoryInterface
{
    /**
     * Find a product given it's id.
     *
     * @param $id
     *
     * @return Product
     * @throws ModelNotFoundException
     */
    public function find($id);

    /**
     * Get all products.
     *
     * @return Collection
     */
    public function all();
}
