<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FixDetailBugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:extras';

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
        $detail_extras = \DB::table('page_detail_extras')
            ->where('key', 'quantity')
            ->orWhere('key', 'summary')
            ->orWhere('key', 'summary_two')
            ->orWhere('key', 'summary_three')
            ->orWhere('key', 'usage_area')
            ->orWhere('key', 'threedparams')
            ->orWhere('key', 'button_text')
            ->orWhere('key', 'button_url')
            ->orWhere('key', 'file_embed')
            ->groupBy('page_detail_id', 'key')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach($detail_extras as $extra){
            \DB::table('page_detail_extras')->where('id', $extra->id)->delete();
        }

        $detail_extras = \DB::table('sitemap_detail_extras')
            ->orWhere('key', 'button_text')
            ->orWhere('key', 'button_url')
            ->orWhere('key', 'file_embed')
            ->groupBy('page_detail_id', 'key')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        foreach($detail_extras as $extra){
            \DB::table('sitemap_detail_extras')->where('id', $extra->id)->delete();
        }

        $this->info('Hatalı veriler düzenlendi');
    }
}
