<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Estate;
use App\Models\Service;
use App\Models\Sponsorship;
use App\Models\User;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class EstateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        $estates = config('estates');

        $user_ids = User::pluck('id')->toArray();
        $category_ids = Category::pluck('id')->toArray();
        $service_ids = Service::pluck('id')->toArray();

        foreach ($estates as $estate) {
            $new_estate = new Estate();

            $new_estate->user_id = Arr::random($user_ids);
            $new_estate->category_id = Arr::random($category_ids);
            $new_estate->fill($estate);

            $new_estate->save();

            $estate_services = [];

            $totalservices = count($service_ids);

            foreach ($service_ids as $service_id) {
                if ($faker->boolean()) $estate_services[] = $service_id;
            }
            if ($estate_services === [])  $estate_services[] = rand(1, $totalservices);

            $new_estate->services()->attach($estate_services);
        }
    }
}
