<?php

namespace Database\Seeders;

use App\Models\Category;
use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        $labels = [
            'Villa',
            'Appartamento',
            'Chalet',
            'Cascina',
        ];






        foreach ($labels as $label) {
            $category = new Category;

            $category->label = $label;
            $category->color = $faker->hexColor();
            $category->save();
        };
    }
}
