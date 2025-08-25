<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use Faker\Provider\en_US\Person;
use Faker\Provider\en_US\Address;
use Faker\Provider\en_US\Company;

class PersonSearchDudokSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create('en_US');
        $faker->addProvider(new Person($faker));
        $faker->addProvider(new Address($faker));
        $faker->addProvider(new Company($faker));

        // Pre-generate unique values
        $clientIds = [];
        $registrationNos = [];
        $nationalIds = [];

        for ($i = 0; $i < 500; $i++) {
            $clientIds[] = 'CL-' . ($i + 1000);
            $registrationNos[] = 'REG-' . (100000 + $i);
            $nationalIds[] = $faker->numerify('##########') . sprintf('%02d', $i % 100);
        }

        // Shuffle to make them random
        shuffle($clientIds);
        shuffle($registrationNos);
        shuffle($nationalIds);

        $batchSize = 50;
        $totalRecords = 500;
        $data = [];

        for ($i = 0; $i < $totalRecords; $i++) {
            $data[] = [
                'REGISTRATION_NO' => $registrationNos[$i],
                'COMPANY_NAME' => $faker->company,
                'CLIENT_ID' => $clientIds[$i],
                'PERSON_NAME' => $faker->name,
                'FATHERS_NAME' => $faker->name('male'),
                'NATIONAL_ID' => $nationalIds[$i],
                'BIRTH_DATE' => $faker->dateTimeBetween('-60 years', '-18 years'),
                'PRESENT_ADDRESS' => $faker->address,
                'PERMANENT_ADDRESS' => $faker->address,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (($i + 1) % $batchSize === 0 || $i === $totalRecords - 1) {
                DB::table('person_search_dudok')->insert($data);
                $data = [];
                echo "Inserted " . ($i + 1) . " records\n";
            }
        }
    }
}
