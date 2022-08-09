<?php

use App\Courier;
use Illuminate\Database\Seeder;

class CourierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['code' => 'jne', 'name' => 'JNE'],
            ['code' => 'tiki', 'name' => 'TIKI'],
            ['code' => 'pos', 'name' => 'Pos Indonesia'],
        ];
        Courier::insert($data);
    }
}
