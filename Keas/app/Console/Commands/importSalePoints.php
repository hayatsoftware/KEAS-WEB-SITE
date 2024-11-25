<?php

namespace App\Console\Commands;

use App\SalePointExtras;
use App\SalePoints;
use Illuminate\Console\Command;
use Mediapress\Modules\Content\Models\Page;

class importSalePoints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:sale-points';

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
        $files = \File::files(public_path('import/sale_points'));

        $file_data = [];
        foreach( $files as $file ){
            $file_data[] = $file->getFilename();
        }
        $pageFile = $this->choice('Please select file',$file_data, 0);
        $sale_points = collect(json_decode(file_get_contents(public_path('import/sale_points/'.$pageFile)), TRUE));
        $zone_id = $this->ask('Please type zone id');
        foreach( $sale_points as $point ){

            $sale_point = SalePoints::create([
                'native_name' => $point['native_name'],
                'localized_name' => $point['localized_name'],
                'phone' => $point['phone'],
                'email' => $point['email'],
                'website' => $point['website'],
                'native_city' => $point['native_city'],
                'localized_city' => $point['localized_city'],
                'city_slug' => \Str::slug($point['native_city'], '-'),
                'native_address' => $point['native_address'],
                'localized_address' => $point['localized_address'],
                'cords' => $point['cords'],
                'zone_id' => $zone_id,
            ]);

            $dealer_categories = explode(',', $point['category_id']);
            foreach( $dealer_categories as $category ){
                $dealer_category = Page::where('sitemap_id', 35)->where('cint_1', $category)->first();
                if($dealer_category){
                    SalePointExtras::create([
                        'sale_points_id' => $sale_point->id,
                        'key' => 'category',
                        'value' => $dealer_category->id
                    ]);
                }

            }

            $dealer_types = explode(',', $point['type_id']);
            foreach( $dealer_types as $type ){

                $dealer_type = Page::where('sitemap_id', 36)->where('cint_1', $type)->first();
                if($dealer_type){
                    SalePointExtras::create([
                        'sale_points_id' => $sale_point->id,
                        'key' => 'type',
                        'value' => $dealer_type->id
                    ]);
                }
            }

        }
    }
}
