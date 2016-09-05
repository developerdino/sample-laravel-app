<?php

namespace App\Repositories\Cache;


use App\Category;
use App\Contracts\Repositories\CategoryRepositoryInterface;
use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CachingCategoryRepository implements CategoryRepositoryInterface
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $repository;
    /**
     * @var Cache
     */
    private $cache;

    /**
     * CachingCategoryRepository constructor.
     *
     * @param CategoryRepositoryInterface $repository
     * @param Cache                       $cache
     */
    public function __construct(CategoryRepositoryInterface $repository, Cache $cache)
    {
        $this->repository = $repository;
        $this->cache      = $cache;
    }

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
        return $this->cache->remember(
            'category.by-id-' . $id,
            config('cache.ttl.category'),
            function () use ($id) {
                return $this->repository->find($id);
            }
        );
    }

    /**
     * Get a collection of all categories.
     *
     * @return Collection
     */
    public function all()
    {
        return $this->cache->remember(
            'category.all',
            config('cache.ttl.category'),
            function () {
                return $this->repository->all();
            }
        );
    }
}
