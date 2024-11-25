<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class SalePoints implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(): \Illuminate\Support\Collection
    {
        $points = \DB::table('sale_points')
            ->select([
                'sale_points.id',
                'sale_points.native_name',
                'sale_points.localized_name',
                'sale_points.phone',
                'sale_points.email',
                'sale_points.website',
                'sale_points.native_city',
                'sale_points.localized_city',
                'sale_points.city_slug',
                'sale_points.native_address',
                'sale_points.localized_address',
                'sale_points.cords',
                'sale_points.status',
                'sale_points.zone_id as zone'
            ])
            ->get()
            ->toArray();
        $points = json_decode(json_encode($points), TRUE);
        $export_data = [];
        foreach($points as $key => $point){
            $zone = \DB::table('country_groups')->where('id', $point['zone'])->first();
            $export_data[$key] = $point;
            $export_data[$key]['status'] = $point['status'] == 1 ? "Active":"Deactive";
            $export_data[$key]['zone'] = $zone->list_title;
            $export_data[$key]['country'] = "";
        }
        $headers = collect([["id", "native_name", "localized_name", "phone", "email", "website", "native_city", "localized_city", "city_slug", "native_address", "localized_address", "cords", "status", "zone", "country"]]);
        $result = $headers->merge(collect($export_data));
        return $result;
    }
}
