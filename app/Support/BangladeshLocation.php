<?php

namespace App\Support;

use App\Models\LocationArea;
use App\Models\LocationDistrict;
use App\Models\LocationThana;

class BangladeshLocation
{
    public static function namesFromIds(?int $districtId, ?int $thanaId, ?int $areaId): array
    {
        $district = $districtId ? LocationDistrict::query()->find($districtId) : null;
        $thana = $thanaId
            ? LocationThana::query()
                ->when($districtId, fn ($query) => $query->where('district_id', $districtId))
                ->find($thanaId)
            : null;
        $area = $areaId
            ? LocationArea::query()
                ->when($thanaId, fn ($query) => $query->where('thana_id', $thanaId))
                ->find($areaId)
            : null;

        return [
            'district' => $district?->name,
            'thana' => $thana?->name,
            'area' => $area?->name,
        ];
    }

    public static function idsFromNames(?string $districtName, ?string $thanaName, ?string $areaName): array
    {
        $districtId = $districtName
            ? LocationDistrict::query()->where('name', $districtName)->value('id')
            : null;
        $thanaId = $thanaName
            ? LocationThana::query()
                ->when($districtId, fn ($query) => $query->where('district_id', $districtId))
                ->where('name', $thanaName)
                ->value('id')
            : null;
        $areaId = $areaName
            ? LocationArea::query()
                ->when($thanaId, fn ($query) => $query->where('thana_id', $thanaId))
                ->where('name', $areaName)
                ->value('id')
            : null;

        return [
            'district_id' => $districtId,
            'thana_id' => $thanaId,
            'area_id' => $areaId,
        ];
    }

    public static function composeAddress(?string $district, ?string $thana, ?string $area): string
    {
        return collect([$area, $thana, $district])->filter()->implode(', ');
    }
}
