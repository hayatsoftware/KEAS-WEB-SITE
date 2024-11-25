<?php

namespace App\Console\Commands;

use App\Services\Page;
use Illuminate\Console\Command;
use Mediapress\Modules\Content\Models\Category;
use Mediapress\Modules\MPCore\Models\CountryGroup;
use Mediapress\Modules\MPCore\Models\CountryGroupLanguage;
use Mediapress\Modules\MPCore\Models\Language;

class importTezgahProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:worktop-products';

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
        $productGroups = collect(json_decode(file_get_contents(public_path('import/tezgah/products.json')), TRUE))->groupBy('decor_code');
        $productCollections = collect(json_decode(file_get_contents(public_path('import/tezgah/product_data.json')), TRUE));
        $dimensionData = collect(json_decode(file_get_contents(public_path('import/tezgah/ebat.json')), TRUE));
        $thicknessData = collect(json_decode(file_get_contents(public_path('import/tezgah/kalinlik.json')), TRUE));
        $lastProductPage = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', PRODUCT_ST_ID)->whereNotNull('cint_2')->orderBy('cint_2', 'DESC')->first();
        $lastProductPageExplode = explode('-', $lastProductPage->cint_2);
        $count = intval($lastProductPageExplode[1]);
        foreach( $productGroups as $key => $productWrap ){
            $brandGroupByPage = $productWrap->groupBy('brand');
            foreach( $brandGroupByPage as $product ){
                $count++;
                $productData = [];
                $category = Category::find(14);
                $productImport = new Page();
                $code = str_pad($count,5,"0",STR_PAD_LEFT);
                $product_code = "KSWT-".$code;
                $brand_id = $product[0]['brand'];
                if( $brand_id != '-' ){
                    $productImport->setCintOne($brand_id);
                }
                $decor_code = $product[0]['decor_code'];
                $productImport->setCintTwo($product_code);
                $productImport->setCintThree($product[0]['decor_code']);
                $productImport->setSitemapId(PRODUCT_ST_ID);
                $productImport->setCategory($category->id);
                $importProduct = $productImport->importPageCheckWithCintTwo();
                $productPageId = $importProduct->id;
                foreach( $product as $productItem ){
                    $zones = explode(',', $productItem['zones']);
                    foreach( $zones as $zone ){
                        $zone_detail = $zonesCollection->where('id', $zone)->first();
                        $country_group = CountryGroup::where('code',  $zone_detail['code'])->first();
                        $countryGroupsLanguage = CountryGroupLanguage::where('country_group_id', $country_group->id)->get();
                        foreach( $countryGroupsLanguage as $groupLanguage ){
                            $language = Language::where('id', $groupLanguage->language_id)->first();
                            $productData[$country_group->id][$language->id]['name'] = $productItem[$language->code].'-'.$productItem['decor_code'].'-'.$product_code;
                            $productData[$country_group->id][$language->id]['extra_features'] = $productItem['extra_features'];
                            $productData[$country_group->id][$language->id]['surface'] = $productItem['surface'];
                            $productData[$country_group->id][$language->id]['brand'] = $productItem['brand'];
                            $productData[$country_group->id][$language->id]['decor'] = $productItem['decor'];
                        }
                    }
                }

                $getZonesData = [];
                \DB::table('page_detail_extras')->where('page_id', $productPageId)->delete();
                foreach( $productData as $country_id => $productLanguages ){
                    array_push($getZonesData, $country_id);
                    foreach($productLanguages as $language_id => $detail){
                        $productImport->setPageId($productPageId);
                        $productImport->setLanguageId($language_id);
                        $productImport->setCountryId($country_id);
                        $productImport->setName($detail['name']);
                        $productImport->setSlug($detail['name']);
                        $productDetailImport = $productImport->importPageDetail();
                        $productDetailId = $productDetailImport->id;
                        $country_group_single = CountryGroup::where('id', $country_id)->first();
                        $features = false;
                        if( $decor_code != '-' ){
                            $features = $productCollections->where('decor_code', $decor_code)->first();
                        }

                        if($features){
                            // Ebatlar aktarılıyor
                            if($features['ebat_'.$country_group_single->code] != '-'){
                                $dimensions = explode(',',$features['ebat_'.$country_group_single->code]);

                                foreach( $dimensions as $dimension ){
                                    $dimensionValue = $dimensionData->where('ID', $dimension)->first();
                                    if($dimensionValue){
                                        $productImport->importPageDetailExtras($productPageId, $productDetailId, 'dimension', $dimensionValue['ebat']);
                                    }

                                }
                            }

                            // Kalınlıklar aktarılıyor
                            if($features['kalinlik_'.$country_group_single->code] != '-'){
                                $thicknesses = explode(',',$features['kalinlik_'.$country_group_single->code]);
                                foreach( $thicknesses as $thickness ){
                                    $thicknessValue = $thicknessData->where('ID', $thickness)->first();
                                    if($thicknessValue){
                                        $productImport->importPageDetailExtras($productPageId, $productDetailId, 'thickness', $thicknessValue['kalinlik']);
                                    }
                                }
                            }


                            // Sertifikalar aktarılıyor
                            if($features['sertifika_'.$country_group_single->code] != '-'){
                                $certificates = explode(',',$features['sertifika_'.$country_group_single->code]);
                                foreach( $certificates as $certificate ){
                                    $certificatePage = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', WORKTOP_CERTIFICATES_ST_ID)->where('cint_1', $certificate)->first();
                                    if( $certificatePage ){
                                        $productImport->importPageDetailExtras($productPageId, $productDetailId, 'certificate', $certificatePage->id);
                                    }
                                }
                            }


                            // Özellikler aktarılıyor
                            if($features['ozellik_'.$country_group_single->code] != '-'){
                                $Productfeatures = explode(',',$features['ozellik_'.$country_group_single->code]);
                                foreach( $Productfeatures as $feature ){
                                    $featurePage = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', WORKTOP_FEATURES_ST_ID)->where('cint_1', $feature)->first();
                                    if($featurePage){
                                        $productImport->importPageDetailExtras($productPageId, $productDetailId, 'features', $featurePage->id);
                                    }
                                }
                            }
                        }

                        // Decor aktarılıyor
                        if($productItem['decor'] != '-'){
                            $decors = explode(',',$productItem['decor']);
                            foreach( $decors as $decor ){
                                $decorPage = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', WORKTOP_DECORS_ST_ID)->where('cint_1', $decor)->first();
                                if($decorPage){
                                    $productImport->importPageDetailExtras($productPageId, $productDetailId, 'decor', $decorPage->id);
                                }

                            }
                        }
                        // Extra Özellikler aktarılıyor
                        if($productItem['extra_features'] != '-'){
                            $extrafeatures = explode(',',$detail['extra_features']);
                            foreach( $extrafeatures as $extrafeature ){
                                $extrafeaturePage = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', WORKTOP_EXTRA_FEATURES_ST_ID)->where('cint_1', $extrafeature)->first();
                                if($extrafeaturePage){
                                    $productImport->importPageDetailExtras($productPageId, $productDetailId, 'extra_feature', $extrafeaturePage->id);
                                }

                            }
                        }
                        // Yüzey aktarılıyor
                        if( $productItem['surface'] != '-' ){
                            $surfaces = explode(',',$detail['surface']);
                            foreach( $surfaces as $surface ){
                                $surfacePage = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', WORKTOP_SURFACES_ST_ID)->where('cint_1', $surface)->first();
                                if($surfacePage){
                                    $productImport->importPageDetailExtras($productPageId, $productDetailId, 'surface', $surfacePage->id);
                                }
                            }
                        }

                        if( $brand_id != '-' ){
                            $brandPage = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', BRANDS_ST_ID)->where('cint_1', $brand_id)->first();
                            if($brandPage){
                                $productImport->importPageDetailExtras($productPageId, $productDetailId, 'brand', $brandPage->id);
                            }
                        }

                    }
                }
                $nonZonesData = CountryGroupLanguage::whereNotIn('country_group_id', $getZonesData)->get()->groupBy('country_group_id')->toArray();
                foreach( $nonZonesData as $country_id => $languages ){
                    foreach($languages as $language){
                        $pageName = '-'.$productItem['decor_code'].'-'.$product_code;
                        $productImport->setPageId($productPageId);
                        $productImport->setLanguageId($language['language_id']);
                        $productImport->setCountryId($country_id);
                        $productImport->setName($pageName);
                        $productImport->setSlug($pageName);
                        $productDetailImport = $productImport->importPageDetail();
                        $productDetailImport->delete();
                    }
                }
            }

        }
        $this->info(PHP_EOL . 'Ürünler başarılı şekilde import edildi.' . PHP_EOL);
    }
}
