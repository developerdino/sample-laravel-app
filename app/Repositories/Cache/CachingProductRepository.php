<?php

namespace App\Repositories\Cache;


use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Product;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CachingProductRepository implements ProductRepositoryInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private $repository;
    /**
     * @var Cache
     */
    private $cache;

    /**
     * CachingProductRepository constructor.
     *
     * @param ProductRepositoryInterface $repository
     * @param Cache                      $cache
     */
    public function __construct(ProductRepositoryInterface $repository, Cache $cache)
    {
        $this->repository = $repository;
        $this->cache      = $cache;
    }

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
        return $this->cache->remember(
            'product.by-id-' . $id,
            config('cache.ttl.product'),
            function () use ($id) {
                return $this->repository->find($id);
            }
        );
    }

    /**
     * Get all products.
     *
     * @return Collection
     */
    public function all()
    {
        return $this->cache->remember(
            'product.all',
            config('cache.ttl.product'),
            function () {
                return $this->repository->all();
            }
        );
    }
}
