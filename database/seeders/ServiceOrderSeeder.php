<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));
        $users = User::pluck('id')->all();

        for ($i = 0; $i < 100; $i++) {
            $entryDateTime = $faker->dateTimeThisYear();
            $exitDateTime = $faker->dateTimeBetween($entryDateTime);

            DB::table('service_orders')->insert([
                'user_id'          => $faker->randomElement($users),
                'vehicle_plate'    => $faker->vehicleRegistration('[A-Z]{3}-[0-9]{4}'),
                'entry_date_time'  => $entryDateTime,
                'exit_date_time'   => $exitDateTime,
                'price_type'       => $faker->randomElement(['Real', 'Dólar', 'Euro', 'Libra', 'Peso']),
                'price'            => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 1000),
                'created_at'       => now(),
                'updated_at'       => now()
            ]);
        }
    }
}
