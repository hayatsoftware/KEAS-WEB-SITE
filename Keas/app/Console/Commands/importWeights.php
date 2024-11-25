<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mediapress\Modules\Content\Models\Page;

class importWeights extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:weights';

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
        $weight_data = [];
        \DB::table('pages')->where('sitemap_id', 33)->delete();
        $weights = \DB::table('page_detail_extras')->where('key', 'weight')->get()->pluck('value')->unique();
        foreach( $weights as $weight ){
            array_push($weight_data, $weight);
        }

        $weightResult = collect($weight_data)->unique();

        foreach( $weightResult as $result ){
            Page::create([
                'sitemap_id' => 33,
                'admin_id' => 1,
                'page_id' => 0,
                'status' => 1,
                'cvar_1' => $result,
                'allowed_role_id' => 0
            ]);
        }
    }
}
