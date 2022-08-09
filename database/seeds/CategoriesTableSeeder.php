<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        Category::create([
            'name' => 'Benih',
            'slug' => 'benih',
            'desc' => 'Benih Kategori'
        ]);
        Category::create([
            'name' => 'Pupuk',
            'slug' => 'pupuk',
            'desc' => 'Pupuk Kategori'
        ]);
        Category::create([
            'name' => 'Peralatan',
            'slug' => 'peralatan',
            'desc' => 'Peralatan Kategori'
        ]);
        Category::create([
            'name' => 'Other',
            'slug' => 'other',
            'desc' => 'Other Kategori'
        ]);
    }
}
