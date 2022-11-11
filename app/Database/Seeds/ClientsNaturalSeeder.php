<?php

namespace App\Database\Seeds;

use App\Models\Clients;
use App\Models\ClientsNatural;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Exception;
use Faker\Factory;
use ReflectionException;

class ClientsNaturalSeeder extends Seeder
{
    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public function run()
    {
        $client = new ClientsNatural();
        $faker = Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $client->save(
                [
                    'name'        =>    $faker->name,
                    'cpf'         =>    $faker->phoneNumber,
                    'adress' => $faker->address
                ]
            );
        }

    }
}
