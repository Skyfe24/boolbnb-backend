<?php

namespace Database\Seeders;

use App\Models\Estate;
use App\Models\Message;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        $estate_ids = Estate::pluck('id')->toArray();
        for ($i = 0; $i < 5; $i++) {
            $message = new Message();

            $message->name = $faker->firstName($gender = 'male');
            $message->email = $faker->email();
            $message->text = $faker->paragraph();
            $message->estate_id = Arr::random($estate_ids);

            $message->save();
        }
    }
}
