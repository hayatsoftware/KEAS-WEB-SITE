<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class stringValuetoInteger extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reform:values';

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
        $values = \DB::table('page_detail_extras')
            ->whereIn('key', ['dimension','thickness','weight','area'])
            ->get();
        foreach( $values as $value ){
            if( $value->key == 'dimension' ){
                $dimensionPage = \DB::table('pages')->where('sitemap_id', 24)->where('cvar_1', $value->value)->first();
                if($dimensionPage){
                    \DB::table('page_detail_extras')->where('id', $value->id)->update([
                        'value' => $dimensionPage->id
                    ]);
                }

            }
            if( $value->key == 'thickness' ){
                $thicknessPage = \DB::table('pages')->where('sitemap_id', 25)->where('cvar_1', $value->value)->first();
                if($thicknessPage){
                    \DB::table('page_detail_extras')->where('id', $value->id)->update([
                        'value' => $thicknessPage->id
                    ]);
                }

            }
            if( $value->key == 'area' ){
                $areaPage = \DB::table('pages')->where('sitemap_id', 34)->where('cvar_1', $value->value)->first();
                if($areaPage){
                    \DB::table('page_detail_extras')->where('id', $value->id)->update([
                        'value' => $areaPage->id
                    ]);
                }

            }
            if( $value->key == 'weight' ){
                $weightPage = \DB::table('pages')->where('sitemap_id', 33)->where('cvar_1', $value->value)->first();
                if($weightPage){
                    \DB::table('page_detail_extras')->where('id', $value->id)->update([
                        'value' => $weightPage->id
                    ]);
                }

            }
        }

        $values = \DB::table('page_extras')
            ->where('key', 'thickness')
            ->get();
        foreach( $values as $value ){
            $thicknessPage = \DB::table('pages')->where('sitemap_id', 25)->where('cvar_1', $value->value)->first();
            if($thicknessPage){
                \DB::table('page_extras')->where('id', $value->id)->update([
                    'value' => $thicknessPage->id
                ]);
            }
        }
    }
}
