<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mediapress\Modules\Content\Models\Page;

class importThickness extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:thickness';

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
        $dimension_data = [];
        \DB::table('pages')->where('sitemap_id', 25)->delete();
        $dimensions = \DB::table('page_detail_extras')->where('key', 'thickness')->get()->pluck('value')->unique();
        foreach( $dimensions as $dimension ){
            array_push($dimension_data, $dimension);
        }
        $dimensionExtras = \DB::table('page_extras')->where('key', 'thickness')->get()->pluck('value')->unique();
        foreach( $dimensionExtras as $dimension ){
            array_push($dimension_data, $dimension);
        }
        $dimensionsResult = collect($dimension_data)->unique();

        foreach( $dimensionsResult as $result ){
            Page::create([
                'sitemap_id' => 25,
                'admin_id' => 1,
                'page_id' => 0,
                'status' => 1,
                'cvar_1' => $result,
                'allowed_role_id' => 0
            ]);
        }
    }
}
