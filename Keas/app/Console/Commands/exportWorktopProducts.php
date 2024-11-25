<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Mediapress\Modules\Content\Models\Category;
use Mediapress\Modules\Content\Models\Page;
use Mediapress\Modules\Content\Models\PageDetailExtra;
use Mediapress\Modules\MPCore\Models\Language;

class exportWorktopProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:worktop-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $products = Page::where('status', 1)
            ->where('sitemap_id', PRODUCT_ST_ID)
            ->whereHas('categories', function($query) {
                return  $query->where('id', 14);
            })
            ->get();
        $i = -1;
        $export_data = [];
        foreach( $products as $product ){
            $i++;
            $export_data[$i]['id'] = $product->id;
            $export_data[$i]['product_id'] = $product->cint_2;
            $export_data[$i]['decor_code'] = $product->cint_3;
            $export_data[$i]['brand'] = $product->cint_1;
            $productDetails = collect($product->details()->get()->groupBy('country_group_id')->toArray());
            foreach( $productDetails as $country_id =>  $productDetails ){
                $extraFeatures = PageDetailExtra::where('page_detail_id', $productDetails[0]['id'])->where('key', 'extra_feature')->get()->pluck('value')->toArray();
                $surfaces = PageDetailExtra::where('page_detail_id', $productDetails[0]['id'])->where('key', 'surface')->get()->pluck('value')->toArray();
                $decor =  PageDetailExtra::where('page_detail_id', $productDetails[0]['id'])->where('key', 'decor')->get()->pluck('value')->toArray();
                $brand =  PageDetailExtra::where('page_detail_id', $productDetails[0]['id'])->where('key', 'brand')->get()->pluck('value')->toArray();

                $extraFeaturesData = implode('_', $extraFeatures);
                $surfaceData = implode('_', $surfaces);
                $decorData = implode('_', $decor);
                $brandData = implode('_', $brand);

                $export_data[$i]['details'][$country_id]['row_data'] = 'extra_features,'.$extraFeaturesData.'|surface,'.$surfaceData.'|decor,'.$decorData.'|brand,'.$brandData;
                $export_data[$i]['details'][$country_id]['country_id'] = $country_id;
                foreach( $productDetails as $detail ){
                    $language = Language::where('id', $detail['language_id'])->first();
                    $detailNameExplode = explode('-', $detail['name']);
                    $export_data[$i]['details'][$country_id]['names'][$language->code] = $detailNameExplode[0];

                }
                $export_data[$i]['new_detail'] = collect($export_data[$i]['details'])->unique('row_data')->all();
            }

        }
        $result_array = [];
        $i = -1;
        foreach( $export_data as $data ){
            foreach( $data['new_detail'] as $detail ){
                $i++;
                $result_array[$i]['id'] = $data['id'];
                $result_array[$i]['decor_code'] = $data['decor_code'];
                $result_array[$i]['product_id'] = $data['product_id'];
                $detailCollection = collect($data['details'])->where('row_data', $detail['row_data']);
                $names_data = [];
                foreach( $detailCollection as $collection ){
                    foreach($collection['names'] as $key => $name){
                        $names_data[$key] = $name;
                    }
                }
                if( array_key_exists('tr', $names_data) ){
                    $result_array[$i]['tr'] = $names_data['tr'];
                }else{
                    $result_array[$i]['tr'] = '-';
                }
                if( array_key_exists('en', $names_data) ){
                    $result_array[$i]['en'] = $names_data['en'];
                }else{
                    $result_array[$i]['en'] = '-';
                }
                if( array_key_exists('ru', $names_data) ){
                    $result_array[$i]['ru'] = $names_data['ru'];
                }else{
                    $result_array[$i]['ru'] = '-';
                }
                if( array_key_exists('it', $names_data) ){
                    $result_array[$i]['it'] = $names_data['it'];
                }else{
                    $result_array[$i]['it'] = '-';
                }
                if( array_key_exists('bg', $names_data) ){
                    $result_array[$i]['bg'] = $names_data['bg'];
                }else{
                    $result_array[$i]['bg'] = '-';
                }
                if( array_key_exists('ro', $names_data) ){
                    $result_array[$i]['ro'] = $names_data['ro'];
                }else{
                    $result_array[$i]['ro'] = '-';
                }
                if( array_key_exists('es', $names_data) ){
                    $result_array[$i]['es'] = $names_data['es'];
                }else{
                    $result_array[$i]['es'] = '-';
                }
                if( array_key_exists('fr', $names_data) ){
                    $result_array[$i]['fr'] = $names_data['fr'];
                }else{
                    $result_array[$i]['fr'] = '-';
                }
                $row_data = explode('|', $detail['row_data']);
                $extraFeatures = explode(',', $row_data[0]);
                $surfaces = explode(',', $row_data[1]);
                $decor = explode(',', $row_data[2]);
                $brand = explode(',', $row_data[3]);

                if($brand[1] != ""){
                    $brandData = explode('_', $brand[1]);
                    $brandName = [];
                    foreach( $brandData as $brand ){
                        $brandPage = \DB::table('pages')
                            ->select('pages.id', 'pages.sitemap_id', 'page_details.name')
                            ->where('sitemap_id', BRANDS_ST_ID)
                            ->where('page_details.page_id', $brand)
                            ->join('page_details', 'pages.id', '=', 'page_details.page_id')
                            ->where('page_details.language_id', 616)
                            ->first();
                        array_push($brandName, $brandPage->name);
                    }
                    $result_array[$i]['brand'] = implode(',', $brandName);
                }else{
                    $result_array[$i]['brand'] = '-';
                }

                if($decor[1] != ""){
                    $decorData = explode('_', $decor[1]);
                    $decorName = [];
                    foreach( $decorData as $decor ){
                        $decorPage = \DB::table('pages')
                            ->select('pages.id', 'pages.sitemap_id', 'page_details.name')
                            ->where('sitemap_id', WORKTOP_DECORS_ST_ID)
                            ->where('page_details.page_id', $decor)
                            ->join('page_details', 'pages.id', '=', 'page_details.page_id')
                            ->where('page_details.language_id', 616)
                            ->first();
                        array_push($decorName, $decorPage->name);
                    }
                    $result_array[$i]['decor'] = implode(',', $decorName);
                }else{
                    $result_array[$i]['decor'] = '-';
                }

                if( $extraFeatures[1] != "" ){
                    $featuresData = explode('_', $extraFeatures[1]);
                    $featureNameData = [];
                    foreach( $featuresData as $feature ){
                        $featurePage = \DB::table('pages')
                            ->select('pages.id', 'pages.sitemap_id', 'page_details.name')
                            ->where('sitemap_id', WORKTOP_EXTRA_FEATURES_ST_ID)
                            ->where('page_details.page_id', $feature)
                            ->join('page_details', 'pages.id', '=', 'page_details.page_id')
                            ->where('page_details.language_id', 616)
                            ->first();
                        array_push($featureNameData, $featurePage->name);
                    }
                    $result_array[$i]['extra_features'] = implode(',', $featureNameData);
                }else{
                    $result_array[$i]['extra_features'] = '-';
                }

                if( $surfaces[1] != "" ){
                    $surfacesData = explode('_', $surfaces[1]);
                    $surfaceNameData = [];
                    foreach( $surfacesData as $surface ){
                        $surfacePage = \DB::table('pages')
                            ->select('pages.id', 'pages.sitemap_id', 'page_details.name')
                            ->where('sitemap_id', WORKTOP_SURFACES_ST_ID)
                            ->where('page_details.page_id', $surface)
                            ->join('page_details', 'pages.id', '=', 'page_details.page_id')
                            ->where('page_details.language_id', 616)
                            ->first();
                        array_push($surfaceNameData, $surfacePage->name);
                    }
                    $result_array[$i]['surfaces'] = implode(',', $surfaceNameData);
                }else{
                    $result_array[$i]['surfaces'] = '-';
                }
                $result_array[$i]['matte_gloss'] = 'Matte';
            }
        }
        Storage::disk('public')->put('worktop_products.json', json_encode($result_array, JSON_UNESCAPED_UNICODE));
    }
}
