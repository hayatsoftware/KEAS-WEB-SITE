<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mediapress\Modules\Content\Models\Category;
use Mediapress\Modules\Content\Models\CategoryDetail;
use Mediapress\Modules\Content\Models\SitemapDetail;
use Mediapress\Modules\MPCore\Models\CountryGroup;
use Mediapress\Modules\MPCore\Models\CountryGroupLanguage;
use Mediapress\Modules\MPCore\Models\Language;
use Mediapress\Modules\MPCore\Models\Url;

class importCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import categories from json';

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
        $categories = json_decode(file_get_contents(public_path('import/categories.json')), TRUE);
        $zonesCollection = collect(json_decode(file_get_contents(public_path('import/zones.json')), TRUE));
        foreach( $categories as $category ){
            $mainCategory = Category::updateOrCreate(
                [
                    'id' => $category['id']
                ],
                [
                    'sitemap_id' => 3,
                    'category_id' => $category['parent_id'],
                    'admin_id' => 1,
                    'status' => 1
                ]
            );
            $zones = explode(",", $category['zone']);
            $zones_data = [];
            foreach( $zones as $zone ){
                $zone_detail = $zonesCollection->where('id', $zone)->first();
                $country_group = CountryGroup::where('code', $zone_detail['code'])->first();
                if( $country_group ){
                    $zones_data[] = $country_group->id;
                }
            }
            $countryGroupsLanguage = CountryGroupLanguage::all();
            foreach( $countryGroupsLanguage as $groupLanguage ){
                $language = Language::where('id', $groupLanguage->language_id)->first();
                $categoryDetailData = [
                    'category_id' => $mainCategory->id,
                    'language_id' => $groupLanguage->language_id,
                    'country_group_id' => $groupLanguage->country_group_id
                ];
                if( !in_array($groupLanguage->country_group_id, $zones_data) ){
                    $categoryDetailDataUpdate['deleted_at'] = \Carbon\Carbon::now()->toDateTimeString();
                    $categoryDetailDataUpdate['name'] = "-";
                }else{
                    $categoryDetailDataUpdate['name'] = $category[$language->code];
                    $categoryDetailDataUpdate['deleted_at'] = NULL;
                }
                $categoryDetailDataUpdate['slug'] = \Str::slug($categoryDetailDataUpdate['name'], '-');
                $category_detail = CategoryDetail::updateOrCreate($categoryDetailData,$categoryDetailDataUpdate);
                if( !in_array($groupLanguage->country_group_id, $zones_data) ){
                    $category_detail->delete();
                }
                //$sitemap_detail = SitemapDetail::where('sitemap_id', 3)->where('language_id', $groupLanguage->language_id)->where('country_group_id', $groupLanguage->country_group_id)->first();

            }
        }
        $this->info(PHP_EOL . 'Kategoriler başarılı şekilde import edildi.' . PHP_EOL);
    }
}
