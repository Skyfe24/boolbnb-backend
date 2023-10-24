<?php

namespace Database\Seeders;

use App\Models\Estate;
use App\Models\Visit;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        $estate_ids = Estate::pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            $visit = new Visit();

            $visit->estate_id = Arr::random($estate_ids);
            $visit->date = $faker->date();
            $visit->ip_address = $faker->ipv4();

            $visit->save();
        }
    }
}
