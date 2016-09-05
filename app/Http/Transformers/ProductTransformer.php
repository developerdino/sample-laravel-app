<?php

namespace App\Http\Transformers;


use App\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * List of resources to possibly include
     *
     * @var  array
     */
    protected $availableIncludes = [
        'category',
    ];

    /**
     * List of resources to automatically include
     *
     * @var  array
     */
    protected $defaultIncludes = [];

    /**
     * @param $product
     *
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'id'          => $product->id,
            'title'       => $product->title,
            'description' => $product->description,
            'slug'        => $product->slug,
        ];
    }

    /**
     * Include the products category relationship.
     *
     * @param Product $product
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeCategory(Product $product)
    {
        return $this->item($product->category, new CategoryTransformer);
    }
}
