<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mediapress\Modules\Content\Models\Page;
use Mediapress\Modules\Content\Models\PageDetail;

class updateProductName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:product-name';

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
        $products = \DB::table('pages')->where('sitemap_id', 3)->get();
        foreach( $products as $product ){
            $product_details = \DB::table('page_details')->where('page_id', $product->id)->get();
            foreach( $product_details as $detail ){
                if( $detail->deleted_at != NULL ){
                    \DB::table('page_details')
                        ->where('id', $detail->id)
                        ->update([
                            'name' => NULL,
                            'detail' => NULL,
                            'slug' => NULL
                        ]);
                }else{
                    $detailName = explode('-',$detail->name);
                    PageDetail::where('id', $detail->id)->update([
                        'name' => $detailName[0]
                    ]);
                }
            }
        }
    }
}
