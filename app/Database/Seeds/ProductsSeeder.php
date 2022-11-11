<?php

namespace App\Database\Seeds;

use App\Models\Products;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        $product = new Products();
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $product->save(
                [
                    'name'        =>    $faker->name,
                    'description'         => $faker->realText,
                    'price'        =>    $faker->numberBetween(1,5000),
                    'stock'  =>    $faker->numberBetween(1,100),
                ]
            );
        }
    }
}
