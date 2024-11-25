<?php

namespace App\Modules\Content\Website1\DataSources;

use Illuminate\Support\Facades\Cache;
use Mediapress\Foundation\DataSource;

class Categories extends DataSource
{
    public function getData()
    {
        return Cache::rememberForever(hash('md5', 'MediapressCategories' ), function () {
            $data = [];
            $categories = \DB::table('categories')
                ->select('categories.id', 'category_details.name')
                ->join('category_details', function($join){
                    $join->on('category_details.category_id', '=', 'categories.id')
                        ->where(function($query){
                            return $query->where('category_details.name', '!=', NULL)
                                ->where('category_details.language_id', 616)
                                ->where('category_details.name', '!=', '-');
                        })
                        ->where('category_details.language_id', 616)
                        ->where('category_details.deleted_at', NULL);
                })
                ->where('categories.sitemap_id', PRODUCT_ST_ID)
                ->get();
            foreach($categories as $category){
                $data[$category->id] = $category->name;
            }
            return $data;
        });
    }
}
