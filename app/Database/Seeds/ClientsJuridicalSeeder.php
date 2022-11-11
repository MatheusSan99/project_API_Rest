<?php

namespace App\Database\Seeds;

use App\Models\ClientsJuridical;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ClientsJuridicalSeeder extends Seeder
{
    public function run()
    {
        $client = new ClientsJuridical();
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $client->save(
                [
                    'trade_name'        =>    $faker->name,
                    'cnpj'         =>    $faker->phoneNumber,
                    'adress' => $faker->address
                ]
            );
        }
    }
}
