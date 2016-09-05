<?php

namespace App\Repositories\Eloquent;


use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentProductRepository implements ProductRepositoryInterface
{
    /**
     * Find a product given it's id.
     *
     * @param $id
     *
     * @return Product
     * @throws ModelNotFoundException
     */
    public function find($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Get all products.
     *
     * @return Collection
     */
    public function all()
    {
        return Product::all();
    }
}
