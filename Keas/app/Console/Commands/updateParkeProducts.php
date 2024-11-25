<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mediapress\Modules\Content\Models\Page;
use Mediapress\Modules\Content\Models\PageDetail;
use Mediapress\Modules\Content\Models\PageDetailExtra;

class updateParkeProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:parke-products';

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
        $productData = collect(json_decode(file_get_contents(public_path('import/parke/categories.json')), TRUE));
        $dimensionData = collect(json_decode(file_get_contents(public_path('import/parke/ebat.json')), TRUE));
        $quantityData = collect(json_decode(file_get_contents(public_path('import/parke/adet.json')), TRUE));
        $weightsData = collect(json_decode(file_get_contents(public_path('import/parke/agirlik.json')), TRUE));
        $areaData = collect(json_decode(file_get_contents(public_path('import/parke/alan.json')), TRUE));
        $detailData = collect(json_decode(file_get_contents(public_path('import/parke/aciklama.json')), TRUE));
        $category_data = [];
        $categories = \DB::table('categories')->where('category_id', 15)->get()->pluck('id');
        foreach( $categories as $category ){
            $child_categories = \DB::table('categories')->where('category_id', $category)->get()->pluck('id');
            foreach($child_categories as $id){
                array_push($category_data, $id);
            }
        }

        $products = Page::where('sitemap_id', PRODUCT_ST_ID)
            ->whereHas('categories', function($query)use($category_data){
                return $query->whereIn('id', $category_data);
            })
            ->where('status', 1)
            ->get();
        foreach( $products as $product ){
            foreach($product->details as $detail){
                $detail->detail = NULL;
                $detail->save();
            }
        }
        $this->info(PHP_EOL . 'Ürünler başarılı şekilde düzenlendi.' . PHP_EOL);
    }
}
