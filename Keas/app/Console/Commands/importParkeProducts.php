<?php

namespace App\Console\Commands;

use App\Services\Page;
use Illuminate\Console\Command;
use Mediapress\Modules\Content\Models\Category;
use Mediapress\Modules\MPCore\Models\CountryGroup;
use Mediapress\Modules\MPCore\Models\CountryGroupLanguage;
use Mediapress\Modules\MPCore\Models\Language;

class importParkeProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:parke-products';

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
        $files = \File::files(public_path('import/parke'));

        $file_data = [];
        foreach( $files as $file ){
            $file_data[] = $file->getFilename();
        }
        $productFile = $this->choice('Please select file',$file_data, 0);
        $products = collect(json_decode(file_get_contents(public_path('import/parke/'.$productFile)), TRUE));
        $zonesCollection = collect(json_decode(file_get_contents(public_path('import/zones.json')), TRUE));
        $surfaceData = collect(json_decode(file_get_contents(public_path('import/parke-surfaces.json')), TRUE));
        $decorData = collect(json_decode(file_get_contents(public_path('import/parke-decors.json')), TRUE));
        $thicknessData = collect(json_decode(file_get_contents(public_path('import/parke-kalinlik.json')), TRUE));
        $lockData = collect(json_decode(file_get_contents(public_path('import/parke-lock.json')), TRUE));
        $bevelData = collect(json_decode(file_get_contents(public_path('import/parke-bevel.json')), TRUE));
        $classData = collect(json_decode(file_get_contents(public_path('import/parke-class.json')), TRUE));
        $lastProductPage = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', PRODUCT_ST_ID)->whereNotNull('cint_2')->orderBy('cint_2', 'DESC')->first();
        $lastProductPageExplode = explode('-', $lastProductPage->cint_2);
        $count = intval($lastProductPageExplode[1]);

        foreach( $products as $product ){
            $count++;
            $category = Category::find($product['category_id']);
            $zones = explode(",", $product['zones']);
            $zones_data = [];
            foreach( $zones as $zone ){
                $zone_detail = $zonesCollection->where('id', $zone)->first();
                $country_group = CountryGroup::where('code', $zone_detail['code'])->first();
                if( $country_group ){
                    $zones_data[] = $country_group->id;
                }
            }
            $productImport = new Page();
            $code = str_pad($count,5,"0",STR_PAD_LEFT);
            $product_code = "KSPP-".$code;
            $productImport->setCintTwo($product_code);
            $productImport->setCintThree($product['decor_code']);
            $productImport->setCategory($category->id);
            $productImport->setSitemapId(PRODUCT_ST_ID);
            $importProduct = $productImport->importPageCheckWithCintTwo();
            $productPageId = $importProduct->id;
            $countryGroupsLanguage = CountryGroupLanguage::all();
            \DB::table('page_extras')->where('page_id', $productPageId)->delete();
            foreach( $countryGroupsLanguage as $groupLanguage ){
                $language = Language::where('id', $groupLanguage->language_id)->first();
                $productImport->setPageId($productPageId);
                $productImport->setLanguageId($groupLanguage->language_id);
                $productImport->setCountryId($groupLanguage->country_group_id);
                $pageName = $product[$language->code].'-'.$product['decor_code'].'-'.$product_code;
                $productImport->setName($pageName);
                $productImport->setSlug($pageName);
                $productDetailImport = $productImport->importPageDetail();
                if( !in_array($groupLanguage->country_group_id, $zones_data) ){
                    $productDetailImport->delete();
                }else{
                    if(isset($product['surface'])){
                        $surfaces = explode(',',  $product['surface']);
                        foreach( $surfaces as $surface ){
                            $surfaceJson = $surfaceData->where('ID', $surface)->first();
                            $surfacePage = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', PANEL_SURFACES_ST_ID)->where('cint_1', $surfaceJson['ID'])->first();
                            $productImport->importPageExtras($productPageId, 'surface', $surfacePage->id);
                        }
                    }

                    if(isset($product['decor'])){
                        $decor = $decorData->where('ID', $product['decor'])->first();
                        $decorPage = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', PANEL_DECORS_ST_ID)->where('cint_1', $decor['ID'])->first();
                        $productImport->importPageExtras($productPageId, 'decor', $decorPage->id);
                    }

                    if(isset($product['thickness'])){
                        $thickness = $thicknessData->where('ID', $product['thickness'])->first();
                        $productImport->importPageExtras($productPageId, 'thickness', $thickness['kalinlik']);
                    }

                    if(isset($product['lock'])){
                        $lock = $lockData->where('ID', $product['lock'])->first();
                        $lockPage = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', PANEL_LOCKS_ST_ID)->where('cint_1', $lock['ID'])->first();
                        $productImport->importPageExtras($productPageId, 'lock', $lockPage->id);
                    }

                    if(isset($product['bevel'])){
                        $bevel = $bevelData->where('ID', $product['bevel'])->first();
                        $bevelPage = \Mediapress\Modules\Content\Models\Page::where('sitemap_id', PANEL_BEVELS_ST_ID)->where('cint_1', $bevel['ID'])->first();
                        $productImport->importPageExtras($productPageId, 'bevel', $bevelPage->id);
                    }

                    if(isset($product['class'])){
                        $class = $classData->where('ID', $product['class'])->first();
                        $productImport->importPageExtras($productPageId, 'class', $class['class']);
                    }

                    if(isset($product['height'])){
                        $productImport->importPageExtras($productPageId, 'height', $product['height']);
                    }
                }
            }
        }
        $this->info(PHP_EOL . 'Ürünler başarılı şekilde import edildi.' . PHP_EOL);
    }
}
