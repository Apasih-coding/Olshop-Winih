<?php

use App\Status;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::truncate();

        Status::create([
            'name' => 'in Progress',
            'desciption' => 'Dalam proses pembayaran'
        ]);
        Status::create([
            'name' => 'Packing',
            'desciption' => 'Barang dalam proses dikemas'
        ]);
        Status::create([
            'name' => 'Delivered',
            'desciption' => 'Barang dikirim ke penerima'
        ]);
        Status::create([
            'name' => 'Paid',
            'desciption' => 'Barang telah dibayar'
        ]);
        Status::create([
            'name' => 'Success',
            'desciption' => 'Orderan telah diterima'
        ]);
    }
}
