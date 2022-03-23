<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->loadFromJson();

        foreach ($data['categories'] as $category) {
            $this->storeCategory($category);
        }
    }

    public function loadFromJson()
    {
        $json = file_get_contents(__DIR__ . '/sources/products_and_categories.json');
        $array = json_decode($json, true, 512, JSON_OBJECT_AS_ARRAY);
        return $array;
    }

    public function storeCategory($data, $parentId = null)
    {
        $name = $data['name'];
        $subcategories = !empty($data['categories']) ? $data['categories'] : [];
        $products = !empty($data['products']) ? $data['products'] : [];

        $now = Carbon::now();

        $categoryId = DB::table('categories')->insertGetId([
            'name' => $name,
            'parent_id' => $parentId,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        if (!empty($subcategories)) {
            foreach ($subcategories as $subcategory) {
                $this->storeCategory($subcategory, $categoryId);
            }
        }

        if (!empty($products)) {
            foreach ($products as $product) {
                $this->storeProduct($product, $categoryId);
            }
        }
    }

    public function storeProduct($data, $categoryId = null)
    {
        $name = $data['name'];
        $price = !empty($data['price']) ? $data['price'] : 0;
        $description = !empty($data['description']) ? $data['description'] : '';

        $now = Carbon::now();

        DB::table('products')->insert([
            'name' => $name,
            'price' => $price,
            'description' => $description,
            'category_id' => $categoryId,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}

