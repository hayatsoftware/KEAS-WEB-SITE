<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Mediapress\Modules\Content\Models\Category;
use Mediapress\Modules\Content\Models\CategoryDetail;
use Mediapress\Modules\Content\Models\CategoryPage;
use Mediapress\Modules\Content\Models\Page;
use Mediapress\Modules\Content\Models\PageDetail;
use Mediapress\Modules\Content\Models\PageExtra;
use Mediapress\Modules\MPCore\Models\Language;

class exportParkeProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:parke-products';

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

        $categories = Category::where('category_id', 15)->get()->pluck('id')->toArray();
        $subCategories = Category::whereIn('category_id', $categories)->get()->pluck('id');
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
            $product_data[$i]['id'] =$product->id;
            $product_data[$i]['product_id'] =$product->cint_2;
            $product_data[$i]['main_category'] = $mainCategoryDetail->name;
            $product_data[$i]['sub_category'] = $productCategoryDetail->name;
            $product_data[$i]['decor_code'] =$product->cint_3;
            $productDetails = collect($product->details()->get()->groupBy('country_group_id')->toArray());
            $language_data = [];
            foreach( $productDetails as $country_id =>  $productDetails ){
                foreach( $productDetails as $detail ){
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

            $decors = PageExtra::where('page_id', $product->id)->where('key', 'decor')->get()->pluck('value')->toArray();
            $decor_data = [];
            foreach( $decors as $decor ){
                $decorPage = Page::where('sitemap_id', PANEL_DECORS_ST_ID)->where('id', $decor)->first();
                $decorPageDetail = PageDetail::where('page_id', $decorPage->id)->where('language_id', 616)->where('name', '!=', '-')->first();
                array_push($decor_data, $decorPageDetail->name);
            }
            if(count($decor_data) > 0){
                $product_data[$i]['decor'] = implode(',', $decor_data);
            }else{
                $product_data[$i]['decor'] = '-';
            }

            $surfaces = PageExtra::where('page_id', $product->id)->where('key', 'surface')->get()->pluck('value')->toArray();
            $surface_data = [];
            foreach( $surfaces as $surface ){
                $surfacePage = Page::where('sitemap_id', PANEL_SURFACES_ST_ID)->where('id', $surface)->first();
                $surfacePageDetail = PageDetail::where('page_id', $surfacePage->id)->where('language_id', 616)->where('name', '!=', '-')->first();
                array_push($surface_data, $surfacePageDetail->name);
            }
            if(count($surface_data) > 0){
                $product_data[$i]['surface'] = implode(',', $surface_data);
            }else{
                $product_data[$i]['surface'] = '-';
            }

            $locks = PageExtra::where('page_id', $product->id)->where('key', 'lock')->get()->pluck('value')->toArray();
            $lock_data = [];
            foreach( $locks as $lock ){
                $lockPage = Page::where('sitemap_id', PANEL_LOCKS_ST_ID)->where('id', $lock)->first();
                $lockPageDetail = PageDetail::where('page_id', $lockPage->id)->where('language_id', 616)->where('name', '!=', '-')->first();
                array_push($lock_data, $lockPageDetail->name);
            }
            if(count($lock_data) > 0){
                $product_data[$i]['lock'] = implode(',', $lock_data);
            }else{
                $product_data[$i]['lock'] = '-';
            }

            $bevels = PageExtra::where('page_id', $product->id)->where('key', 'bevel')->get()->pluck('value')->toArray();
            $bevel_data = [];
            foreach( $bevels as $bevel ){
                $bevelPage = Page::where('sitemap_id', PANEL_BEVELS_ST_ID)->where('id', $bevel)->first();
                $bevelPageDetail = PageDetail::where('page_id', $bevelPage->id)->where('language_id', 616)->where('name', '!=', '-')->first();
                array_push($bevel_data, $bevelPageDetail->name);
            }
            if(count($bevel_data) > 0){
                $product_data[$i]['bevel'] = implode(',', $bevel_data);
            }else{
                $product_data[$i]['bevel'] = '-';
            }

            $thicknesses = PageExtra::where('page_id', $product->id)->where('key', 'thickness')->get()->pluck('value')->toArray();
            if(count($thicknesses) > 0){
                $product_data[$i]['thickness'] = implode(',', $thicknesses);
            }else{
                $product_data[$i]['thickness'] = '-';
            }

            $classes = PageExtra::where('page_id', $product->id)->where('key', 'class')->get()->pluck('value')->toArray();
            if(count($classes) > 0){
                $product_data[$i]['class'] = implode(',', $classes);
            }else{
                $product_data[$i]['class'] = '-';
            }

            $heights = PageExtra::where('page_id', $product->id)->where('key', 'height')->get()->pluck('value')->toArray();
            if(count($heights) > 0){
                $product_data[$i]['height'] = implode(',', $heights);
            }else{
                $product_data[$i]['height'] = '-';
            }
        }
        Storage::disk('public')->put('parke_products.json', json_encode($product_data, JSON_UNESCAPED_UNICODE));
        $this->info(PHP_EOL.'Ürünler başarılı şekilde dışarı aktarıldı.'.PHP_EOL);
    }
}
