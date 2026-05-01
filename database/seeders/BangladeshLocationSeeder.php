<?php

namespace Database\Seeders;

use App\Models\LocationArea;
use App\Models\LocationDistrict;
use App\Models\LocationThana;
use Illuminate\Database\Seeder;

class BangladeshLocationSeeder extends Seeder
{
    public function run(): void
    {
        $districts = json_decode(file_get_contents(database_path('data/bangladesh/districts.json')), true)[2]['data'] ?? [];
        $thanas = json_decode(file_get_contents(database_path('data/bangladesh/thanas.json')), true)[2]['data'] ?? [];
        $areas = json_decode(file_get_contents(database_path('data/bangladesh/areas.json')), true)[2]['data'] ?? [];

        LocationDistrict::query()->upsert(
            collect($districts)->map(fn ($district) => [
                'id' => (int) $district['id'],
                'division_id' => (int) $district['division_id'],
                'name' => $district['name'],
                'bn_name' => $district['bn_name'] ?? null,
                'lat' => $district['lat'] ?? null,
                'lon' => $district['lon'] ?? null,
                'url' => $district['url'] ?? null,
            ])->all(),
            ['id'],
            ['division_id', 'name', 'bn_name', 'lat', 'lon', 'url']
        );

        LocationThana::query()->upsert(
            collect($thanas)->map(fn ($thana) => [
                'id' => (int) $thana['id'],
                'district_id' => (int) $thana['district_id'],
                'name' => $thana['name'],
                'bn_name' => $thana['bn_name'] ?? null,
                'url' => $thana['url'] ?? null,
            ])->all(),
            ['id'],
            ['district_id', 'name', 'bn_name', 'url']
        );

        LocationArea::query()->upsert(
            collect($areas)->map(fn ($area) => [
                'id' => (int) $area['id'],
                'thana_id' => (int) $area['upazilla_id'],
                'name' => $area['name'],
                'bn_name' => $area['bn_name'] ?? null,
                'url' => $area['url'] ?? null,
            ])->all(),
            ['id'],
            ['thana_id', 'name', 'bn_name', 'url']
        );
    }
}
