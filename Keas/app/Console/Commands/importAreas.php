<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mediapress\Modules\Content\Models\Page;

class importAreas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:areas';

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
        $area_data = [];
        \DB::table('pages')->where('sitemap_id', 34)->delete();
        $areas = \DB::table('page_detail_extras')->where('key', 'area')->get()->pluck('value')->unique();
        foreach( $areas as $area ){
            array_push($area_data, $area);
        }

        $areaResult = collect($area_data)->unique();

        foreach( $areaResult as $result ){
            Page::create([
                'sitemap_id' => 34,
                'admin_id' => 1,
                'page_id' => 0,
                'status' => 1,
                'cvar_1' => $result,
                'allowed_role_id' => 0
            ]);
        }
    }
}
