<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Mediapress\Modules\Content\Models\Category;
use Mediapress\Modules\Content\Models\CategoryDetail;
use Mediapress\Modules\Content\Models\CategoryPage;
use Mediapress\Modules\Content\Models\Page;
use Mediapress\Modules\Content\Models\PageDetail;
use Mediapress\Modules\Content\Models\PageDetailExtra;
use Mediapress\Modules\Content\Models\PageExtra;
use Mediapress\Modules\MPCore\Models\CountryGroup;
use Mediapress\Modules\MPCore\Models\Language;

class exportDoorPanel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:door-panel';

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
        $categories = Category::where('category_id', 11)->get()->pluck('id')->toArray();
        $subCategories = Category::whereIn('id', $categories)->get()->pluck('id');
        $products = Page::where('sitemap_id', PRODUCT_ST_ID)
            ->whereHas('categories', function($query) use ($subCategories){
                return $query->whereIn('id', $subCategories);
            })
            ->get();

        $product_data = [];
        $i = -1;
        foreach( $products as $product ){
            $i++;
            $productCategoryPage = CategoryPage::where('page_id', $product->id)->first();
            $productCategory = Category::where('id', $productCategoryPage->category_id )->first();
            $productCategoryDetail = CategoryDetail::where('category_id', $productCategory->id)->where('language_id', 616)->where('name', '!=', '-')->first();
            $mainCategory = Category::where('id', $productCategory->category_id)->first();
            $mainCategoryDetail = CategoryDetail::where('category_id', $mainCategory->id)->where('language_id', 616)->where('name', '!=', '-')->first();

            $brandPage = Page::where('sitemap_id', BRANDS_ST_ID)->where('cint_1', $product->cint_1)->first();
            $brandPageDetail = PageDetail::where('page_id', $brandPage->id)->where('language_id', 616)->where('name', '!=', '-')->first();
            $product_data[$i]['id'] =$product->id;
            $product_data[$i]['product_id'] =$product->cint_2;
            $product_data[$i]['main_category'] = $mainCategoryDetail->name;
            $product_data[$i]['sub_category'] = $productCategoryDetail->name;
            $product_data[$i]['decor_code'] = $product->cint_3;
            $product_data[$i]['brand'] = $brandPageDetail->name;
            $productDetails = collect($product->details()->get()->groupBy('country_group_id')->toArray());
            $language_data = [];
            foreach( $productDetails as $country_id =>  $productDetail ){
                foreach( $productDetail as $detail ){
                    $language = Language::where('id', $detail['language_id'])->first();
                    $detailNameExplode = explode('-', $detail['name']);
                    if($detailNameExplode[0] != '-'){
                        if($detailNameExplode[0] == ''){
                            $language_data[$language->code] = 'Name Required';
                        }else{
                            $language_data[$language->code] = $detailNameExplode[0];
                        }
                    }else{
                        $language_data[$language->code] = '-';
                    }
                }
                $countryGroup = CountryGroup::find($country_id);

                $dimensions = PageDetailExtra::where('page_detail_id', $productDetail[0]['id'])->where('key', 'dimension')->get()->pluck('value')->toArray();
                if( count($dimensions) > 0 ){
                    $product_data[$i]['ebat_'.$countryGroup->code] = implode(',', $dimensions);
                }else{
                    $product_data[$i]['ebat_'.$countryGroup->code] = '-';
                }

                $thicknesses = PageDetailExtra::where('page_detail_id', $productDetail[0]['id'])->where('key', 'thickness')->get()->pluck('value')->toArray();
                if( count($thicknesses) > 0 ){
                    $product_data[$i]['kalinlik_'.$countryGroup->code] = implode(',', $thicknesses);
                }else{
                    $product_data[$i]['kalinlik_'.$countryGroup->code] = '-';
                }

                $features = PageDetailExtra::where('page_detail_id', $productDetail[0]['id'])->where('key', 'feature')->get()->pluck('value')->toArray();
                $feature_data = [];
                foreach( $features as $feature ){
                    $featurePage = Page::where('sitemap_id', DOOR_PANEL_FEATURES_ST_ID)->where('id', $feature)->first();
                    $featurePageDetail = PageDetail::where('page_id', $featurePage->id)->where('language_id', 616)->where('name', '!=', '-')->first();
                    array_push($feature_data, $featurePageDetail->name);
                }
                if( count($feature_data) > 0 ){
                    $product_data[$i]['ozellik_'.$countryGroup->code] = implode(',', $feature_data);
                }else{
                    $product_data[$i]['ozellik_'.$countryGroup->code] = '-';
                }

                $certificates = PageDetailExtra::where('page_detail_id', $productDetail[0]['id'])->where('key', 'certificate')->get()->pluck('value')->toArray();
                $certificate_data = [];
                foreach( $certificates as $certificate ){
                    $certificatePage = Page::where('sitemap_id', DOOR_PANEL_CERTIFICATE_ST_ID)->where('id', $certificate)->first();
                    $certificatePageDetail = PageDetail::where('page_id', $certificatePage->id)->where('language_id', 616)->where('name', '!=', '-')->first();
                    array_push($certificate_data, $certificatePageDetail->name);
                }
                if( count($certificate_data) > 0 ){
                    $product_data[$i]['sertifika_'.$countryGroup->code] = implode(',', $certificate_data);
                }else{
                    $product_data[$i]['sertifika_'.$countryGroup->code] = '-';
                }
            }


            $detailPageEn = $product->details()->where('language_id', 616)->first();
            $surfaces = PageDetailExtra::where('page_detail_id', $detailPageEn->id)->where('key', 'surface')->get()->pluck('value')->toArray();
            $surface_data = [];
            foreach( $surfaces as $surface ){
                $surfacePage = Page::where('sitemap_id', DOOR_PANEL_SURFACES_ST_ID)->where('id', $surface)->first();
                $surfacePageDetail = PageDetail::where('page_id', $surfacePage->id)->where('language_id', 616)->where('name', '!=', '-')->first();
                array_push($surface_data, $surfacePageDetail->name);
            }
            if(count($surface_data) > 0){
                $product_data[$i]['surfaces'] = implode(',', $surface_data);
            }else{
                $product_data[$i]['surfaces'] = '-';
            }

            $textures = PageDetailExtra::where('page_detail_id', $detailPageEn->id)->where('key', 'texture')->get()->pluck('value')->toArray();
            $texture_data = [];
            foreach( $textures as $texture ){
                $texturePage = Page::where('sitemap_id', DOOR_PANEL_TEXTURES_ST_ID)->where('id', $texture)->first();
                $texturePageDetail = PageDetail::where('page_id', $texturePage->id)->where('language_id', 616)->where('name', '!=', '-')->first();
                array_push($texture_data, $texturePageDetail->name);
            }
            if(count($texture_data) > 0){
                $product_data[$i]['textures'] = implode(',', $texture_data);
            }else{
                $product_data[$i]['textures'] = '-';
            }

            $extra_features = PageDetailExtra::where('page_detail_id', $detailPageEn->id)->where('key', 'extra_feature')->get()->pluck('value')->toArray();
            $extra_feature_data = [];
            foreach( $extra_features as $extra_feature ){
                $extraFeaturePage = Page::where('sitemap_id', DOOR_PANEL_EXTRA_FEATURES_ST_ID)->where('id', $extra_feature)->first();
                $extraFeaturePageDetail = PageDetail::where('page_id', $extraFeaturePage->id)->where('language_id', 616)->where('name', '!=', '-')->first();
                array_push($extra_feature_data, $extraFeaturePageDetail->name);
            }
            if(count($extra_feature_data) > 0){
                $product_data[$i]['extra_features'] = implode(',', $extra_feature_data);
            }else{
                $product_data[$i]['extra_features'] = '-';
            }

            if( array_key_exists('tr', $language_data) ){
                $product_data[$i]['tr'] = $language_data['tr'];
            }else{
                $product_data[$i]['tr'] = '-';
            }

            if( array_key_exists('en', $language_data) ){
                $product_data[$i]['en'] = $language_data['en'];
            }else{
                $product_data[$i]['en'] = '-';
            }

            if( array_key_exists('ru', $language_data) ){
                $product_data[$i]['ru'] = $language_data['ru'];
            }else{
                $product_data[$i]['ru'] = '-';
            }

            if( array_key_exists('it', $language_data) ){
                $product_data[$i]['it'] = $language_data['it'];
            }else{
                $product_data[$i]['it'] = '-';
            }

            if( array_key_exists('bg', $language_data) ){
                $product_data[$i]['bg'] = $language_data['bg'];
            }else{
                $product_data[$i]['bg'] = '-';
            }

            if( array_key_exists('ro', $language_data) ){
                $product_data[$i]['ro'] = $language_data['ro'];
            }else{
                $product_data[$i]['ro'] = '-';
            }

            if( array_key_exists('fr', $language_data) ){
                $product_data[$i]['fr'] = $language_data['fr'];
            }else{
                $product_data[$i]['fr'] = '-';
            }

            if( array_key_exists('es', $language_data) ){
                $product_data[$i]['es'] = $language_data['es'];
            }else{
                $product_data[$i]['es'] = '-';
            }

        }

        $result_data = [];
        foreach( $product_data as $key => $data ){
            $result_data[$key]['id'] = $data['id'];
            $result_data[$key]['product_id'] = $data['product_id'];
            $result_data[$key]['main_category'] = $data['main_category'];
            $result_data[$key]['sub_category'] = $data['sub_category'];
            $result_data[$key]['decor_code'] = $data['decor_code'];
            $result_data[$key]['brand'] = $data['brand'];
            $result_data[$key]['tr'] = $data['tr'];
            $result_data[$key]['en'] = $data['en'];
            $result_data[$key]['ru'] = $data['ru'];
            $result_data[$key]['it'] = $data['it'];
            $result_data[$key]['bg'] = $data['bg'];
            $result_data[$key]['ro'] = $data['ro'];
            $result_data[$key]['fr'] = $data['fr'];
            $result_data[$key]['es'] = $data['es'];
            $result_data[$key]['surfaces'] = $data['surfaces'];
            $result_data[$key]['textures'] = $data['textures'];
            $result_data[$key]['extra_features'] = $data['extra_features'];
            $countryGroups = CountryGroup::all();
            foreach(  $countryGroups as $group ){
                if( !isset($data['ebat_'.$group->code]) ){
                    $result_data[$key]['ebat_'.$group->code] = '-';
                }else{
                    $result_data[$key]['ebat_'.$group->code] = $data['ebat_'.$group->code];
                }

                if( !isset($data['kalinlik_'.$group->code]) ){
                    $result_data[$key]['kalinlik_'.$group->code] = '-';
                }else{
                    $result_data[$key]['kalinlik_'.$group->code] = $data['kalinlik_'.$group->code];
                }

                if( !isset($data['ozellik_'.$group->code]) ){
                    $result_data[$key]['ozellik_'.$group->code] = '-';
                }else{
                    $result_data[$key]['ozellik_'.$group->code] = $data['ozellik_'.$group->code];
                }

                if( !isset($data['sertifika_'.$group->code]) ){
                    $result_data[$key]['sertifika_'.$group->code] = '-';
                }else{
                    $result_data[$key]['sertifika_'.$group->code] = $data['sertifika_'.$group->code];
                }
            }

        }

        Storage::disk('public')->put('kapi-panel.json', json_encode($product_data, JSON_UNESCAPED_UNICODE));
        $this->info(PHP_EOL.'Ürünler başarılı şekilde dışarı aktarıldı.'.PHP_EOL);
    }
}
