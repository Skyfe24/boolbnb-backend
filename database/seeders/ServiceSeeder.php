<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['label' => 'Parcheggio', 'icon' => 'square-parking'],
            ['label' => 'WiFi', 'icon' => 'wifi'],
            ['label' => 'Cucina', 'icon' => 'kitchen-set'],
            ['label' => 'TV', 'icon' => 'tv'],
            ['label' => 'Piscina', 'icon' => 'water-ladder'],
            ['label' => 'Portineria', 'icon' => 'user-tie']

        ];

        foreach ($services as $service) {
            $new_service = new  Service();
            $new_service->label = $service['label'];
            $new_service->icon = $service['icon'];
            $new_service->save();
        };
    }
}
