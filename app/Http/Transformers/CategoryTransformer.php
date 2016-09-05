<?php

namespace App\Http\Transformers;


use App\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * List of resources to possibly include
     *
     * @var  array
     */
    protected $availableIncludes = [
        'products',
    ];

    /**
     * List of resources to automatically include
     *
     * @var  array
     */
    protected $defaultIncludes = [];

    /**
     * @param Category $category
     *
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'id'   => $category->id,
            'name' => $category->name,
        ];
    }

    /**
     * Include the category's products relations.
     *
     * @param Category $category
     *
     * @return \League\Fractal\Resource\Collection
     */
    public function includeProducts(Category $category)
    {
        return $this->collection($category->products, new ProductTransformer);
    }
}
