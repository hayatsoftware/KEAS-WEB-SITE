<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mediapress\Modules\Content\Models\Page;
use Mediapress\Modules\Content\Models\PageDetailExtra;

class updateBrands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:brands';

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
        $products = Page::where('sitemap_id', PRODUCT_ST_ID)
            ->whereHas('categories', function($query){
                return $query->where('categories.category_id', 5);
            })
            ->get();
        $productsData = collect(json_decode(file_get_contents(public_path('decorative-panel-products.json')), TRUE));
        foreach($products as $product){
            $category = $product->categories[0];
            $decor_code = $product->cint_3;
            $productDetails = $product->details;
            $productItem = $productsData->where('decor_code', $product->cint_3)->where('brand', '!=', '-')->first();
            if( $productItem && $productItem['brand']  ){
                foreach( $productDetails as $detail ){

                }
            }

        }
    }
}
