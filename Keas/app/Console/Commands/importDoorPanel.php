<?php

namespace App\Console\Commands;

use App\Services\Page;
use Illuminate\Console\Command;
use Mediapress\Modules\Content\Models\Category;
use Mediapress\Modules\MPCore\Models\CountryGroup;
use Mediapress\Modules\MPCore\Models\CountryGroupLanguage;
use Mediapress\Modules\MPCore\Models\Language;

class importDoorPanel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:door-panel';

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
        $zonesCollection = collect(json_decode(file_get_contents(public_path('import/zones.json')), TRUE));
        $products = collect(json_decode(file_get_contents(public_path('import/kapi-panel/products.json')), TRUE));
        $surfaceData = collect(json_decode(file_get_contents(public_path('import//kapi-panel/surface.json')), TRUE));
        $textureData = collect(json_decode(file_get_contents(public_path('import//kapi-panel/texture.json')), TRUE));
        $extraFeaturesData = collect(json_decode(file_get_contents(public_path('import//kapi-panel/extra-features.json')), TRUE));
        $dimensionData = collect(json_decode(file_get_contents(public_path('import//kapi-panel/ebat.json')), TRUE));
        $thicknessData = collect(json_decode(file_get_contents(public_path('import//kapi-panel/kalinlik.json')), TRUE));
        $featureData = collect(json_decode(file_get_contents(public_path('import//kapi-panel/ozellik.json')), TRUE));
        $certificateData = collect(json_decode(file_get_contents(public_path('import//kapi-panel/certificate.json')), TRUE));
        $lastProductPage = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', PRODUCT_ST_ID)->whereNotNull('cint_2')->orderBy('cint_2', 'DESC')->first();
        $lastProductPageExplode = explode('-', $lastProductPage->cint_2);
        $count = intval($lastProductPageExplode[1]);
        foreach( $products as $product ){
            $count++;
            $productData = [];
            $category = Category::find($product['category_id']);
            $productImport = new Page();
            $code = str_pad($count,5,"0",STR_PAD_LEFT);
            $product_code = "KSDP-".$code;
            $brand_id = $product['brand'];
            if( $brand_id != '-' ){
                $productImport->setCintOne($brand_id);
            }
            $productImport->setCintTwo($product_code);
            $productImport->setCintThree($product['decor_code']);
            $productImport->setSitemapId(PRODUCT_ST_ID);
            $productImport->setCategory($category->id);
            $importProduct = $productImport->importPageCheckWithCintTwo();
            $productPageId = $importProduct->id;
            $zones = explode(",", $product['zones']);
            $zones_data = [];
            foreach( $zones as $zone ){
                $zone_detail = $zonesCollection->where('id', $zone)->first();
                $country_group = CountryGroup::where('code', $zone_detail['code'])->first();
                if( $country_group ){
                    $zones_data[] = $country_group->id;
                }
            }
            $countryGroupsLanguage = CountryGroupLanguage::all();
            \DB::table('page_detail_extras')->where('page_id', $productPageId)->delete();
            foreach( $countryGroupsLanguage as $groupLanguage ){
                $language = Language::where('id', $groupLanguage->language_id)->first();
                $country = CountryGroup::find($groupLanguage->country_group_id);
                $productImport->setPageId($productPageId);
                $productImport->setLanguageId($groupLanguage->language_id);
                $productImport->setCountryId($groupLanguage->country_group_id);
                $pageName = $product[$language->code].'-'.$product['decor_code'].'-'.$product_code;
                $productImport->setName($pageName);
                $productImport->setSlug($pageName);
                $productDetailImport = $productImport->importPageDetail();
                $productDetailId = $productDetailImport->id;
                if( !in_array($groupLanguage->country_group_id, $zones_data) ){
                    $productDetailImport->delete();
                }else{
                    if(isset($product['surface']) && $product['surface'] != '-'){
                        $surfaces = explode(',',  $product['surface']);
                        foreach( $surfaces as $surface ){
                            $surfaceJson = $surfaceData->where('ID', $surface)->first();
                            $surfacePage = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', DOOR_PANEL_SURFACES_ST_ID)->where('cint_1', $surfaceJson['ID'])->first();
                            $productImport->importPageDetailExtras($productPageId, $productDetailId,'surface', $surfacePage->id);
                        }
                    }

                    if(isset($product['texture']) && $product['texture'] != '-'){
                        $textures = explode(',',  $product['texture']);
                        foreach( $textures as $texture ){
                            $textureJson = $textureData->where('ID', $texture)->first();
                            $texturePage = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', DOOR_PANEL_TEXTURES_ST_ID)->where('cint_1', $textureJson['ID'])->first();
                            $productImport->importPageDetailExtras($productPageId, $productDetailId,'texture', $texturePage->id);
                        }
                    }

                    if(isset($product['extra_features']) && $product['extra_features'] != '-'){
                        $extra_features = explode(',',  $product['extra_features']);
                        foreach( $extra_features as $extra_feature ){
                            $extraFeatureJson = $extraFeaturesData->where('ID', $extra_feature)->first();
                            $extraFeaturePage = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', DOOR_PANEL_EXTRA_FEATURES_ST_ID)->where('cint_1', $extraFeatureJson['ID'])->first();
                            $productImport->importPageDetailExtras($productPageId, $productDetailId,'extra_feature', $extraFeaturePage->id);
                        }
                    }

                    if(isset($product['ebat_'.$country->code]) && $product['ebat_'.$country->code] != '-'){
                        $ebatlar = explode(',',  $product['ebat_'.$country->code]);
                        foreach( $ebatlar as $ebat ){
                            $ebatJson = $dimensionData->where('ID', $ebat)->first();
                            $productImport->importPageDetailExtras($productPageId, $productDetailId, 'dimension', $ebatJson['ebat']);
                        }
                    }

                    if(isset($product['kalinlik_'.$country->code]) && $product['kalinlik_'.$country->code] != '-'){
                        $thicknesses = explode(',',  $product['kalinlik_'.$country->code]);
                        foreach( $thicknesses as $thickness ){
                            $thicknessJson = $thicknessData->where('ID', $thickness)->first();
                            $productImport->importPageDetailExtras($productPageId, $productDetailId,'thickness', $thicknessJson['kalinlik']);
                        }
                    }

                    if(isset($product['ozellik_'.$country->code]) && $product['ozellik_'.$country->code] != '-'){
                        $features = explode(',',  $product['ozellik_'.$country->code]);
                        foreach( $features as $feature ){
                            $featureJson = $featureData->where('ID', $feature)->first();
                            $featurePage = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', DOOR_PANEL_FEATURES_ST_ID)->where('cint_1', $featureJson['ID'])->first();
                            $productImport->importPageDetailExtras($productPageId, $productDetailId,'feature', $featurePage->id);
                        }
                    }

                    if(isset($product['sertifika_'.$country->code]) && $product['sertifika_'.$country->code] != '-'){
                        $certificates = explode(',',  $product['sertifika_'.$country->code]);
                        foreach( $certificates as $certificate ){
                            $certificateJson = $certificateData->where('ID', $certificate)->first();
                            $certificatePage = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', DOOR_PANEL_CERTIFICATE_ST_ID)->where('cint_1', $certificateJson['ID'])->first();
                            $productImport->importPageDetailExtras($productPageId, $productDetailId,'certificate', $certificatePage->id);
                        }
                    }
                }
            }
        }
        $this->info(PHP_EOL . 'Ürünler başarılı şekilde import edildi.' . PHP_EOL);
    }
}
