<?php

namespace App\Imports;

use App\SalePointExtras;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class SalePoints implements ToCollection, WithHeadingRow, WithChunkReading
{
    /**
    * @param Collection $rows
    */
    public function collection(Collection $rows)
    {
        $country_groups = $this->convertCountryGroups();

        foreach($rows as $row){
            $status = $row['status'] == 'Active' ? 1 : 0;
            $zone_id = $country_groups[str_replace(' ', '', $row['zone'])];
            $active = $row['active'];
            $point = \App\SalePoints::updateOrCreate(
                [
                    'id' => $row['id'],
                ],
                [
                    'native_name' => $row['native_name'],
                    'localized_name' => $row['localized_name'],
                    'phone' => $row['phone'],
                    'email' => $row['email'],
                    'website' => $row['website'],
                    'native_city' => $row['native_city'],
                    'localized_city' => $row['localized_city'],
                    'city_slug' => $row['city_slug'],
                    'native_address' => $row['native_address'],
                    'localized_address' => $row['localized_address'],
                    'cords' => $row['cords'],
                    'status' => $status,
                    'zone_id' => $zone_id,
                    'country' => $row['country'],
                ]
            );
            if($active == 1){
                $static_extras = $this->getStaticExtras($point);
                foreach($static_extras as $extra){
                    SalePointExtras::create($extra);
                }
            }
        }
    }

    public function chunkSize(): int
    {
        return 500;
    }

    private function getStaticExtras($point): array
    {
        $data[0] = [
            'sale_points_id' => $point->id,
            'key' => 'category',
            'value' => 1433
        ];
        $data[1] = [
            'sale_points_id' => $point->id,
            'key' => 'type',
            'value' => 1438
        ];
        return $data;
    }

    private function convertCountryGroups(): array
    {
        $country_groups = \DB::table('country_groups')->get();
        $data = [];
        foreach($country_groups as $group){
            $data[str_replace(' ', '', $group->list_title)] = $group->id;
        }
        return $data;
    }

}
