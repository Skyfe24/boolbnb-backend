<?php

namespace Database\Seeders;

use App\Models\Sponsorship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sponsorships = [
            ['name' => 'Silver', 'level' => 1, 'duration' => 24, 'price' => 2.99],
            ['name' => 'Gold', 'level' => 2, 'duration' => 72, 'price' => 5.99],
            ['name' => 'Platinum', 'level' => 3, 'duration' => 144, 'price' => 9.99],
        ];
        foreach ($sponsorships as $sponsorship) {
            $new_sponsorship = new Sponsorship();
            $new_sponsorship->name = $sponsorship['name'];
            $new_sponsorship->level = $sponsorship['level'];
            $new_sponsorship->duration = $sponsorship['duration'];
            $new_sponsorship->price = $sponsorship['price'];
            $new_sponsorship->save();
        }
    }
}
