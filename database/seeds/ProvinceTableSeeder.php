<?php

use App\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $province = Http::withHeaders([
            'key' => 'f6e9ef80b187dbe293652e78744c2b25'
        ])->get('https://api.rajaongkir.com/starter/province');
        $result = $province['rajaongkir']['results'];
        foreach ($result as $key) {
            $data[] = [
                'id' => $key['province_id'],
                'province' => $key['province'],
            ];
        }
        Province::insert($data);
    }
}
