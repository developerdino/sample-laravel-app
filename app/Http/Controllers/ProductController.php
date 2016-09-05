<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Http\Transformers\ProductTransformer;


class ProductController extends Controller
{
    /**
     * Get all products.
     *
     * @param ProductRepositoryInterface $productRepository
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ProductRepositoryInterface $productRepository)
    {
        $products = $productRepository->all();

        $payload = $this->collection($products, new ProductTransformer);

        return $this->jsonResponse($payload);
    }

    /**
     * Get a product by it's id.
     *
     * @param                            $id
     * @param ProductRepositoryInterface $productRepository
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($id, ProductRepositoryInterface $productRepository)
    {
        $product = $productRepository->find($id);

        $payload = $this->item($product, new ProductTransformer);

        return $this->jsonResponse($payload);
    }
}
