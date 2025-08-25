<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\bn_BD\Person;
use Faker\Provider\bn_BD\Address;
use Faker\Provider\bn_BD\Company;

class PersonSearchDudokFactory extends Factory
{
    public function definition()
    {
        $faker = \Faker\Factory::create('en_US');
        $faker->addProvider(new Person($faker));
        $faker->addProvider(new Address($faker));
        $faker->addProvider(new Company($faker));

        return [
            'REGISTRATION_NO' => 'REG-' . $faker->unique()->numberBetween(100000, 999999),
            'COMPANY_NAME' => $faker->company,
            'CLIENT_ID' => 'CL-' . $faker->unique()->numberBetween(1000, 9999),
            'PERSON_NAME' => $faker->name,
            'FATHERS_NAME' => $faker->name('male'),
            'NATIONAL_ID' => $faker->unique()->numerify('############'), // 12-digit NID
            'BIRTH_DATE' => $faker->dateTimeBetween('-60 years', '-18 years'),
            'PRESENT_ADDRESS' => $faker->address,
            'PERMANENT_ADDRESS' => $faker->address,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
