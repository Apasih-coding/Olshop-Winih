<?php

use App\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::withHeaders([
            'key' => 'f6e9ef80b187dbe293652e78744c2b25'
        ])->get('https://api.rajaongkir.com/starter/city');
        $cities = $response['rajaongkir']['results'];
        foreach ($cities as $city) {
            $data[] = [
                'id' => $city['city_id'],
                'province_id' => $city['province_id'],
                'type' => $city['type'],
                'city_name' => $city['city_name'],
                'postal_code' => $city['postal_code'],
            ];
        }
        City::insert($data);
    }
}
