<?php

use App\Category;
use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 5)->create()->each(function(Category $category) {
            factory(Product::class, 5)->make()->each(function(Product $product) use ($category) {
                $category->products()->save($product);
            });
        });
    }
}
